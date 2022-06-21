<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{Order , OrderOffer , User};
use App\Http\Resources\Dashboard\Order\{OrderResource};
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $created_from_date = '';
        $created_to_date = '';
        if ($request->created_from_date && $request->created_to_date) {
            $created_from_date = Carbon::parse($request->created_from_date)->format('Y-m-d');
            $created_to_date = Carbon::parse($request->created_to_date)->format('Y-m-d');
        }elseif ($request->created_from_date) {
            $created_from_date = Carbon::parse($request->created_from_date)->format('Y-m-d');
        }elseif ($request->created_to_date) {
            $created_to_date = Carbon::parse($request->created_to_date)->format('Y-m-d');
        }

        $query = Order::withTrashed()->when($request->order_status,function($q)use($request){
            if ($request->order_status == 'pending') {
                $q->whereIn('order_status',['pending' , 'client_recieve_offers']);
            }elseif ($request->order_status == 'shipping') {
                $q->whereIn('order_status',['shipped','start_trip','pre_client_accept_start']);
            }elseif ($request->order_status == 'finished') {
                $q->whereIn('order_status',['admin_finish','client_finish','driver_finish']);
            }
        })->when($request->user_type,function($q)use($request){
            if ($request->user_type == 'admin') {
                $q->where('order_status','admin_finish');
            }elseif ($request->user_type == 'driver') {
                $q->where('order_status','driver_finish');
            }elseif ($request->user_type == 'client') {
                $q->where('order_status','client_finish');
            }
        })->when($request->date,function($q)use($request){
            $q->whereDate('created_at',$request->date);
        })->when($request->paid_by,function($q)use($request){
            switch ($request->paid_by) {
                case 'wallet':
                    $q->where('is_paid_by_wallet',true);
                    break;
                case 'cash':
                    $q->where(function ($q)use($request) {
                        $q->where('is_paid_by_wallet',false)->orWhereNull('is_paid_by_wallet');
                    });
                    break;
            }
        })->when($created_from_date || $created_to_date,function ($q) use($created_to_date,$created_from_date){
            if ($created_from_date && $created_to_date) {
                $q->whereBetween('created_at',[$created_from_date , $created_to_date]);
            }elseif ($created_from_date) {
                $q->whereDate('created_at',">=",$created_from_date);
            }elseif ($created_to_date) {
                $q->whereDate('created_at',"<=",$created_to_date);
            }
        })->when($request->status_list,function ($q) use($request) {
            $q->whereIn('order_status',$request->status_list);
        })->latest();

        $data['order_statuses'] = [
            'pending' => trans('dashboard.order.statuses.pending'),
            // 'client_accept_offer' => trans('dashboard.order.statuses.client_accept_offer'),
            'client_recieve_offers' => trans('dashboard.order.statuses.client_recieve_offers'),
            'shipped' => trans('dashboard.order.statuses.shipped'),
            'pre_client_accept_start' => trans('dashboard.order.statuses.pre_client_accept_start'),
            'client_cancel' => trans('dashboard.order.statuses.client_cancel'),
            'admin_cancel' => trans('dashboard.order.statuses.admin_cancel'),
            'driver_cancel' => trans('dashboard.order.statuses.driver_cancel'),
            'start_trip' => trans('dashboard.order.statuses.start_trip'),
            'client_finish' => trans('dashboard.order.statuses.client_finish'),
            'driver_finish' => trans('dashboard.order.statuses.driver_finish'),
            'admin_finish' => trans('dashboard.order.statuses.admin_finish'),
        ];
        $data['app_commission'] = $query->get()->whereIn('order_status',['client_finish','driver_finish','admin_finish'])->sum('app_commission');
        $data['order_count'] = $query->count();
        $data['client_list'] = User::where('user_type','client')->has('clientOrders')->pluck('fullname','id');
        $data['driver_list'] = User::where('user_type','driver')->has('driverOrders')->pluck('fullname','id');

        $order_side_cols = [
            'id','client_id','driver_id','order_type','order_status','created_at'
        ];
        if (request()->ajax()) {
            $keyword = $request->search['value'];
            // dd($order_side_cols);
            $query = $query->when($keyword,function($q)use($keyword){
                $q->where(function ($q) use($keyword) {
                    $q->whereHas('client',function ($q) use($keyword) {
                        $q->where('fullname',"LIKE","%{$keyword}%")->orWhere('email',"LIKE","%{$keyword}%")->orWhere('phone',"LIKE","%{$keyword}%");
                    })->orWhereHas('driver',function ($q) use($keyword) {
                        $q->where('fullname',"LIKE","%{$keyword}%")->orWhere('email',"LIKE","%{$keyword}%")->orWhere('phone',"LIKE","%{$keyword}%");
                    })->orWhere('orders.id',$keyword);
                });
            });

            $data['order_count'] = $query->count();
            $orders = $query->when(isset($order_side_cols[$request['order'][0]['column']]),function ($q) use($request , $order_side_cols) {
                $q->orderBy($order_side_cols[$request['order'][0]['column']],$request['order'][0]['dir']);
            })->when(!isset($order_side_cols[$request['order'][0]['column']]),function ($q) {
                $q->latest();
            })->skip($request['start'])->take($request['length'] == '-1' ? $data['order_count'] : $request['length'])->get();
            data_set($orders,'*.order_statuses',$data['order_statuses']);
            return (new OrderResource($orders))->additional(['order_count' => $data['order_count']]);
        }

        // <==============================Charts============================>

        $order_analytics = $query->get()->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
        });

        for ($i = 0; $i <= 12; $i++) {
            if ($i == 0) {
                if (isset($order_analytics[now()->format('Y-m')])) {
                    $data['order_analytics'][now()->format('Y-m')] = $this->convertToK($order_analytics[now()->format('Y-m')]->count());
                } else {
                    $data['order_analytics'][now()->format('Y-m')] = 0;
                }

                if (isset($order_analytics[now()->format('Y-m')])) {
                    $data['finished_orders_analytics'][now()->format('Y-m')] = $this->convertToK($order_analytics[now()->format('Y-m')]->whereIn('order_status',['client_finish','admin_finish','driver_finish'])->count());
                } else {
                    $data['finished_orders_analytics'][now()->format('Y-m')] = 0;
                }
                if (isset($order_analytics[now()->format('Y-m')])) {
                    $data['pending_orders_analytics'][now()->format('Y-m')] = $this->convertToK($order_analytics[now()->format('Y-m')]->whereIn('order_status',['pending','client_recieve_offers'])->count());
                } else {
                    $data['pending_orders_analytics'][now()->format('Y-m')] = 0;
                }
            } else {
                if (isset($order_analytics[now()->subMonths($i)->format('Y-m')])) {
                    $data['order_analytics'][now()->subMonths($i)->format('Y-m')] = $this->convertToK($order_analytics[now()->subMonths($i)->format('Y-m')]->count());
                } else {
                    $data['order_analytics'][now()->subMonths($i)->format('Y-m')] = 0;
                }
                if (isset($order_analytics[now()->subMonths($i)->format('Y-m')])) {
                    $data['finished_orders_analytics'][now()->subMonths($i)->format('Y-m')] = $this->convertToK($order_analytics[now()->subMonths($i)->format('Y-m')]->whereIn('order_status',['client_finish','admin_finish','driver_finish'])->count());
                } else {
                    $data['finished_orders_analytics'][now()->subMonths($i)->format('Y-m')] = 0;
                }
                if (isset($order_analytics[now()->subMonths($i)->format('Y-m')])) {
                    $data['pending_orders_analytics'][now()->subMonths($i)->format('Y-m')] = $this->convertToK($order_analytics[now()->subMonths($i)->format('Y-m')]->whereIn('order_status',['pending','client_recieve_offers'])->count());
                } else {
                    $data['pending_orders_analytics'][now()->subMonths($i)->format('Y-m')] = 0;
                }
            }
        }

        $data['orders'] = $query->paginate(100);
        if (!request()->ajax()) {
          return view('dashboard.order.index',$data);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['order'] = Order::withTrashed()->findOrFail($id);
        $data['offers'] = $data['order']->offers;
        $data['chats'] = $data['order']->chats;
        $data['messages'] = $data['order']->messages()->latest()->paginate(100);
        $data['format'] = '';
        $data['driver']= $data['order']->driver;
        foreach (auth()->user()->unreadNotifications as $notification) {
            if (isset($notification->data['order_id']) && $notification->data['order_id'] == $data['order']->id && ! $notification->read_at) {
                $notification->markAsRead();
            }
        }
        if (!request()->ajax()) {
            return view('dashboard.order.show',$data);
        }else{
            $view = view('dashboard.order.ajax.message',array_only($data,['order','messages','format']))->render();
            return response()->json(['view' => $view,'value' => 1 ]);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ($order->delete()) {
          return response()->json(['value' => 1]);
        }
    }

    private function convertToK($value)
    {
        // if ($value >= 1000) {
        //     return round($value/1000, 1);
        // } else {
            return $value;
        // }
    }
}
