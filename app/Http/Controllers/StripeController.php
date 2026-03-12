<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Stripe;


class StripeController extends Controller
{
    public function index()
    {
        return view('checkout');
    }


    public function createCharge(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Stripe\Charge::create([
            "amount" => $request->amount * 100,
            "currency" => "cad",
            "source" => $request->stripeToken,
            "description" => "Get Sample Code - Stripe Test  Card Payment"
        ]);
        $payment = new Payment;
        $payment->charge_id = $charge->id;
        $payment->transaction_id = $charge->balance_transaction;
        $payment->amount = number_format(($charge->amount) / 100, 2);
        $payment->card_id = $charge->source->id;
        $payment->card_last_four = $charge->source->last4;
        $payment->card_exp_month = $charge->source->exp_month;
        $payment->card_exp_year = $charge->source->exp_year;
        $payment->postal_code = $charge->source->address_zip;

        $payment->save();
         dd($request->all());

        return redirect('stripe')->with('success', 'Card Payment Successful!');
    }
}
