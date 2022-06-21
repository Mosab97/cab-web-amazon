<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{ WalletTransaction, Order, User};
use Illuminate\Http\Request;
use App\Http\Resources\Dashboard\WalletTransaction\{WalletTransactionResource};
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!request()->ajax() && auth()->user()->email == 'developer@info.com') {
            if ($request->all()) {
                Carbon::setWeekStartsAt(Carbon::SATURDAY);
                Carbon::setWeekEndsAt(Carbon::FRIDAY);

                $from_date = '';
                $to_date = '';
                if ($request->from_date && $request->to_date) {
                    $from_date = date("Y-m-d",strtotime($request->from_date));
                    $to_date = date("Y-m-d",strtotime($request->to_date));
                }elseif ($request->from_date) {
                    $from_date = date("Y-m-d",strtotime($request->from_date));
                }elseif ($request->to_date) {
                    $to_date = date("Y-m-d",strtotime($request->to_date));
                }

                $query = WalletTransaction::where('app_typeable_type',"<>","App\Models\Order")->where('app_typeable_type',"<>","App\Models\TemporaryWallet")->latest()->when($request->user_type,function ($q) use($request) {
                    switch ($request->user_type) {
                        case 'client':
                        $q->whereHas('user',function ($q) {
                            $q->where('user_type','client');
                        });
                        break;
                        case 'driver':
                        $q->whereHas('user',function ($q) {
                            $q->where('user_type','driver');
                        });
                        break;
                    }
                })->when($request->get_date != 'custom',function ($q) use($request,$from_date,$to_date) {
                    switch ($request->get_date) {
                        case 'today':
                        $q->whereDate('created_at',date("Y-m-d"));
                        break;
                        case 'yesterday':
                        $q->whereDate('created_at',date("Y-m-d",strtotime("-1 day")));
                        break;
                        case 'this_week':
                        $q->whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                        break;
                        case 'this_month':
                        $q->where('created_at',"LIKE","%".date("Y-m")."%");
                        break;
                    }
                })->when($request->get_date == 'custom' && $request->custom_date_type,function ($q)use($request,$from_date,$to_date) {
                    switch ($request->custom_date_type) {
                        case 'duration':
                        $q->when($request->from_date || $request->to_date,function($q)use($from_date,$to_date){
                            if ($from_date && $to_date) {
                                $q->whereDate('created_at',">=",$from_date)->whereDate('created_at',"<=",$to_date);
                            }elseif ($from_date) {
                                $q->whereDate('created_at',">=",$from_date);
                            }elseif ($to_date) {
                                $q->whereDate('created_at',"<=",$to_date);
                            }
                        });
                        break;
                        case 'day_month_year':
                        $q->when($request->specicified_date,function($q)use($request){

                            $q->where('created_at',"LIKE","%".$request->specicified_date."%");
                        });
                        break;
                        case 'month_year':
                        $q->when($request->specicified_month,function($q)use($request){

                            $q->where('created_at',"LIKE","%".$request->specicified_month."%");
                        });
                        break;
                        case 'year':
                        $q->when($request->specicified_year,function($q)use($request){
                            $q->where('created_at',"LIKE","%".$request->specicified_year."%");
                        });
                        break;
                    }
                })->when($request->transaction_type,function ($q)use($request) {
                    switch ($request->transaction_type) {
                        case 'charge_by_admin':
                        $q->whereHas('addedBy',function ($q) {
                            $q->whereIn('user_type',['admin','superadmin']);
                        });
                        break;
                        case 'charge_by_card':
                        $q->whereNotNull('transaction_id')->where('transaction_type','charge')->where('transaction_id',"<>","Paid_By_Default_Free");
                        break;
                        case 'withdraw_to_iban':
                        $q->whereNotNull('iban_number')->where(['transaction_type' => 'withdrawal','transfer_status' => 'transfered']);
                        break;
                    }
                });

                $transactions = $query->get()->groupBy(function ($item) use($request){
                    if ($request->custom_date_type == 'month_year' || $request->get_date == 'this_month') {
                        return $item->created_at->isoFormat('Y-MM [week] W');
                    }elseif ($request->custom_date_type == 'year') {
                        return $item->created_at->isoFormat('Y-MM');
                    }else{
                        return $item->created_at->isoFormat('Y-MM-d');
                    }
                });

                if ($request->custom_date_type == 'year') {
                    $transactions->transform(function ($item) {
                        return $item->groupBy(function ($item) {
                            return $item->created_at->isoFormat('Y-MM [week] W');
                        });
                    });
                }
                $get_page = '';
                if ($request->get_date == 'custom' && $request->custom_date_type == 'duration') {
                    $get_page = $this->getDurationType($from_date,$to_date);
                }

                $flatten_transactions = $transactions->flatten();

                return view('dashboard.report.index',compact('transactions','flatten_transactions','get_page'));
            }
            return view('dashboard.report.index');
        }
        abort(404);
    }


    protected function getDurationType($from_date,$to_date)
    {
        $diff = 0;
        if ($from_date && $to_date) {
            $diff = Carbon::parse($from_date)->DiffInDays($to_date);
        }elseif ($from_date && !$to_date) {
            $diff = Carbon::parse($from_date)->DiffInDays(date("Y-m-d"));
        }elseif (!$from_date && $to_date) {
            $diff = Carbon::parse(date("Y-m-d"))->DiffInDays(Carbon::parse($to_date));
        }

        if ($diff == 1) {
            return 'day_month_year';
        }else{
            return 'year';
        }

    }
}
