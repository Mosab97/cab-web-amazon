<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{WalletTransaction};
use Illuminate\Http\Request;

use App\Notifications\General\{GeneralNotification};

class BalanceTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
            $pendingWithdrawals = WalletTransaction::latest()->whereNotNull('iban_number')->where('transaction_type','withdrawal')->pending()->paginate(50);
            $transferedWithdrawals = WalletTransaction::latest()->whereNotNull('iban_number')->where('transaction_type','withdrawal')->transfered()->paginate(50,['*'],'transfer_page');
            $refusedWithdrawals = WalletTransaction::latest()->whereNotNull('iban_number')->where('transaction_type','withdrawal')->refused()->paginate(50,['*'],'refused_page');

            $transfer_statuses = [
                'pending' => trans('dashboard.balance_transfer.transfer_statuses.pending'),
                'transfered' => trans('dashboard.balance_transfer.transfer_statuses.transfered'),
                'refused' => trans('dashboard.balance_transfer.transfer_statuses.refused'),
            ];
            return view('dashboard.balance_transfer.index',compact('pendingWithdrawals','transferedWithdrawals' , 'refusedWithdrawals','transfer_statuses'));
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(WalletTransactionRequest $request)
    // {
    //     if (!request()->ajax()) {
    //         $wallet_transfer = WalletTransaction::where('transaction_type','withdrawal')->findOrFail($request->wallet_id);
    //         $wallet_transfer->update(['transfer_status' => $request->transfer_status , 'transfer_at' => ($request->transfer_status == 'transfered' ? now() : null)]);
    //         try{
    //             // \Mail::to($wallet_transfer->email)->send(new ReplyWalletTransaction($reply));
    //             $pushFcmNotes = [
    //                 'title' => trans('dashboard.fcm.transfer_request'),
    //                 'body' => trans('dashboard.fcm.transfer_statuses.'.$request->status),
    //                 'notify_type' => 'management',
    //             ];
    //             if ($request->send_type == 'fcm') {
    //                 pushFcmNotes($pushFcmNotes, [$wallet_transfer->user_id]);
    //             }else{
    //                 send_sms($wallet_transfer->user->phone,$pushFcmNotes['body']);
    //             }
    //             \Notification::send($wallet_transfer->user,new GeneralNotification($pushFcmNotes+['wallet_id' => $wallet_transfer->id]));
    //         }catch(\Exception $e){
    //             $notSend=1;
    //         }
    //         return redirect(route('dashboard.balance_transfer.index'))->withTrue(trans('dashboard.messages.success_send'));
    //     }
    // }



}
