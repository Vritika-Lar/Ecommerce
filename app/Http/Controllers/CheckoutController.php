<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\OrderPlaced;
use App\Models\Payment;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|size:2',
            'zip_code' => 'required|string|max:20',
            'payment_method' => 'required|in:cod,bank_transfer,stripe',
            'stripeToken' => 'required_if:payment_method,stripe'
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $subtotal = 0;
        foreach ($cart as $productId => $item) {
            if (!isset($products[$productId])) {
                continue;
            }
            $subtotal += ((float) $item['price']) * ((int) $item['quantity']);
        }

        if ($subtotal <= 0) {
            return redirect()->route('cart')->with('error', 'Cart contains invalid items.');
        }

        $shippingCost = 0;
        $tax = round($subtotal * 0.05, 2);
        $totalAmount = $subtotal + $shippingCost + $tax;

        $charge = null;
        if ($request->payment_method === 'stripe') {
            $stripeSecret = config('services.stripe.secret');
            $currency = config('services.stripe.currency', 'IN');

            if (!$stripeSecret) {
                return back()->withErrors(['stripe' => 'Stripe is not configured. Please contact support.']);
            }

            Stripe::setApiKey($stripeSecret);

            try {
                $customer = Customer::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => [
                        'line1' => $request->address,
                        'city' => $request->city,
                        'state' => $request->state,
                        'postal_code' => $request->zip_code,
                        'country' => $request->country,
                    ],
                    'source' => $request->stripeToken,
                ]);

                $charge = Charge::create([
                    'amount' => (int) round($totalAmount * 100),
                    'currency' => $currency,
                    'customer' => $customer->id,
                    'description' => 'E-commerce order payment',
                    'shipping' => [
                        'name' => $request->name,
                        'address' => [
                            'line1' => $request->address,
                            'city' => $request->city,
                            'state' => $request->state,
                            'postal_code' => $request->zip_code,
                            'country' => $request->country,
                        ],
                    ],
                ]);
            } catch (\Throwable $e) {
                Log::error('Stripe charge failed', [
                    'message' => $e->getMessage(),
                    'payment_method' => $request->payment_method,
                    'amount' => $totalAmount,
                    'currency' => $currency,
                ]);

                $errorMessage = app()->environment('local')
                    ? 'Payment failed: ' . $e->getMessage()
                    : 'Payment failed. Please try again.';

                return back()->withErrors(['stripe' => $errorMessage]);
            }
        }

        $order = DB::transaction(function () use (
            $request,
            $cart,
            $products,
            $subtotal,
            $shippingCost,
            $tax,
            $totalAmount,
            $charge
        ) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4)),
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'tax' => $tax,
                'total_amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'payment_status' => $charge ? 'paid' : 'pending',
                'order_status' => 'pending',
            ]);

            foreach ($cart as $productId => $item) {
                if (!isset($products[$productId])) {
                    continue;
                }

                $order->items()->create([
                    'product_id' => (int) $productId,
                    'quantity' => (int) $item['quantity'],
                    'price' => (float) $item['price'],
                ]);
            }

            $order->address()->create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'zip_code' => $request->zip_code,
            ]);

            if ($charge) {
                Payment::create([
                    'order_id' => $order->id,
                    'charge_id' => $charge->id,
                    'transaction_id' => $charge->balance_transaction,
                    'amount' => number_format(((int) $charge->amount) / 100, 2),
                    'currency' => $charge->currency,
                    'card_id' => $charge->source->id ?? '',
                    'card_last_four' => $charge->source->last4 ?? '',
                    'card_exp_month' => $charge->source->exp_month ?? '',
                    'card_exp_year' => $charge->source->exp_year ?? '',
                    'postal_code' => $charge->source->address_zip ?? '',
                ]);
            }

            return $order;
        });

        session()->forget('cart');

        $order->load(['items.product', 'address', 'user']);

        $toEmail = $order->address->email ?? optional($order->user)->email;
        if ($toEmail) {
            try {
                Mail::to($toEmail)->send(new OrderPlaced($order));
            } catch (\Throwable $e) {
                Log::warning('Order confirmation email failed to send.', [
                    'order_id' => $order->id,
                    'email' => $toEmail,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return redirect()->route('orders.success', $order);

    }

    public function success(Order $order)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== 'admin' && (int) $order->user_id !== (int) auth()->id()) {
            abort(403);
        }

        $order->load(['items.product', 'address']);

        return view('orders.success', compact('order'));
    }
}
