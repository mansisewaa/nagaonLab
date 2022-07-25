<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\OrderId;
use App\Models\PaymentWalletRecharge;
use App\Models\User;
use App\Models\WalletMaster;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    //    dd(auth()->user());
       return view('pages.recharge_wallet.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderIdGenerate(Request $request)
    {
        $amount = $request->amount;
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $order = $api->order->create(array('receipt' => now()->timestamp, 'amount' => $amount * 100, 'currency' => 'INR')); // Creates order

        $order_id = $order['id'];
        $params = [
            'amount' => $amount * 100,
            'currency' => 'INR',
            'order_id' => $order_id,
        ];
        $order_data =  OrderId::create([
            'order_id' => $order_id,
            'amount' => $amount,
            'user_id' => auth()->user()->id,
        ]);
        // return redirect()->route('payment')->with('order_id','amount');

        return view('pages.recharge_wallet.payment', compact('amount', 'order_id'));
        // return response()->json(['order_id' => $order_id, 'params' => $paras]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paymentIndex(Request $request)
    {
        return view('pages.recharge_wallet.payment');
    }

    public function storePayment(Request $request)
    {
        // return redirect success
        $data=[
            'date_of_request' => now()->toDateString(),
            'amount_requested' => $request->amount,
            'order_id' => $request->order_id,
            'razorpay_order_id' => $request->razorpay_order_id,
            'payment_id' => $request->razorpay_payment_id,
            'payment_status' => $request->payment_status,
            'payment_details' => $request->payment_description
        ];
        $payment_wallet_recharge = PaymentWalletRecharge::create($data);

        if($request->payment_status == 'S'){
            $ledger_data = [
                'coll_center_id' => auth()->user()->id,
                'ledger_type'  => 'WR', //wallet recharge
                'credit' => $request->amount,
                'transaction_id' => $payment_wallet_recharge->id,
            ];
            $ledger = Ledger::create($ledger_data);

            $wallet = User::where('id',auth()->user()->id)->first();
            $wallet_amount = $wallet->wallet_balance + $request->amount;
            $wallet->update([
                'wallet_balance' => $wallet_amount,
            ]);
        }
        return response()->json(['success' => 'Payment Successful']);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
