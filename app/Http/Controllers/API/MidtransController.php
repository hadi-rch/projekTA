<?php

namespace App\Http\Controllers\API;

use Midtrans\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback()
    {
        //set komfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        //buat intance midtrans notification
        $notification = new Notification();

        //assign ke variable untuk memudahkann koding
        $status = $notification->transaction_status;
        $type = $notification->transaction_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;
        //get transaction id
        $order = explode('-', $order_id);  //['LUX', 4]
        //cari transaksi berdasarkan id
        $transaction = Transaction::findOrFail($order[1]);
        //handle status nnotifikasi midtrans
        if($status == 'capture') {
            if($type == 'credit_card') {
                if($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                }
                else {
                    $transaction->status = 'SUCCESS';
                }
            }
        }
        else if($status == 'settlement')
        {
            $transaction->status = 'SUCCESS';
        }
        else if($status == 'pending')
        {
            $transaction->status = 'PENDING';
        }
        else if($status == 'deny')
        {
            $transaction->status = 'PENDING';
        }
        else if($status == 'expire')
        {
            $transaction->status = 'CANCELLED';
        }
        else if($status == 'cancel')
        {
            $transaction->status = 'CANCELLED';
        }
        //simpan transaksi
        $transaction->save();

        //return respon untuk midtrans
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notification Success'
            ]
            ]);
    }
}
