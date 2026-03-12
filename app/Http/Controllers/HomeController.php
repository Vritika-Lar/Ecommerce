<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Product;
use \App\Models\Category;
use \App\Models\Order;
use \App\Models\OrderItem;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::limit(8)->get();


        return view('homepage', compact('products'));

    }
    public function home(Request $request)
    {
        $products = Product::limit(8)->get();



        return view('index', compact('products'));
    }



    public function shop(Request $request)
    {
        $cat = Category::withCount('products')->get();
        $featuredProducts = Product::where('is_featured', 1)
            ->latest()
            ->limit(5)
            ->get();

        // Get category
        $category = Category::where(
            'slug',
            $request->category ?? 'accessories'
        )->firstOrFail();

        // Get price range from database (for slider)
        $minPrice = $category->products()->min('price');
        $maxPrice = $category->products()->max('price');


        $productsQuery = $category->products()

            ->when($request->keyword, function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->keyword . '%')
                        ->orWhere('description', 'like', '%' . $request->keyword . '%');
                });
            })

            ->when($request->max_price, function ($q) use ($request) {
                $q->where('price', '<=', $request->max_price);
            });

        // sorting
        if ($request->sort == 'low_to_high') {
            $productsQuery->orderBy('price', 'asc');
        } elseif ($request->sort == 'high_to_low') {
            $productsQuery->orderBy('price', 'desc');
        } else {
            $productsQuery->latest();
        }

        $products = $productsQuery->paginate(6);

        // If AJAX request → return JSON
        if ($request->ajax()) {
            return response()->json([
                'products' => $products->items(),
                'pagination' => $products->links()->render()
            ]);
        }

        return view('shop', compact(
            'cat',
            'category',
            'products',
            'minPrice',
            'maxPrice',
            'featuredProducts'
        ))->with('success', 'add to cart');
    }




    public function Cartview(Request $request)
    {
        $product = null;


        if ($request->product) {
            $product = Product::where('is_featured', 1)
                ->latest()
                ->limit(5)
                ->get();

            $product = Product::findOrFail($request->product);
        }

     



        return view('Cartview', compact('product'));
    }



    // app/Http/Controllers/CartController.php
    public function cart()
    {
        $cart = session('cart', []);

        return view('cart', compact('cart'));
    }
    public function add(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = (int) $request->quantity;

        $product = Product::findOrFail($product_id); // ✅ GET PRODUCT

        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;


        } else {
            $cart[$product_id] = [
                'name' => $product->name,     // ✅ correct
                'price' => $product->price,   // ✅ add price
                'quantity' => $quantity
            ];
        }

        session()->put('cart', $cart);

        $totalQuantity = array_sum(array_column($cart, 'quantity'));


        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart',
            'cart_count' => $totalQuantity,
        ]);
    }
    public function addto(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = (int) $request->quantity;

        // if quantity is empty or less than 1
        if ($quantity < 1) {
            $quantity = 1;
        }

        $product = Product::findOrFail($product_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {

            // increase existing quantity
            $cart[$product_id]['quantity'] += $quantity;

        } else {

            // add new product
            $cart[$product_id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity
            ];
        }

        session()->put('cart', $cart);

        $totalQuantity = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart',
            'cart_count' => $totalQuantity,

        ]);
    }
    public function remove(Request $request)
    {
        $product_id = $request->product_id;

        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {

            unset($cart[$product_id]); // remove if quantity = 1
        }

        session()->put('cart', $cart);


        $count = $cart ? array_sum(array_column($cart, 'quantity')) : 0;

        return response()->json([
            'message' => 'Items removed!',
            'count' => $count
        ]);
    }

    public function quantity(Request $request)
    {
        $product_id = $request->product_id;
        $action = $request->action; // increase OR decrease

        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {

            if ($action == "increase") {
                $cart[$product_id]['quantity'] += 1;
                $message = "Quantity increase";
            }

            if ($action == "decrease") {

                if ($cart[$product_id]['quantity'] > 1) {
                    $cart[$product_id]['quantity'] -= 1;
                    $message = "Quantity decrease";
                } else {
                    unset($cart[$product_id]); // remove if becomes 0
                }
            }

            session()->put('cart', $cart);
        }

        $totalQuantity = $cart ? array_sum(array_column($cart, 'quantity')) : 0;

        // Calculate totals
        $itemQuantity = $cart[$product_id]['quantity'] ?? 0;
        $itemPrice = $cart[$product_id]['price'] ?? 0;
        $itemTotal = $itemQuantity * $itemPrice;
        $cartTotal = 0;
        foreach ($cart as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
        }

        $subTotal = 0;
        foreach ($cart as $item) {
            $subTotal += $item['price'] * $item['quantity'];
        }

        $actualTotal = 0;
        foreach ($cart as $item) {
            $actualTotal += $item['price'] * $item['quantity'];
        }
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'cart_count' => $totalQuantity,
            'cart_total' => $cartTotal,
            'sub_total' => $subTotal,
            'actual_total' => $actualTotal,
            'new_quantity' => $itemQuantity,
            'item_total' => $itemTotal   // ✅ ADD THIS
        ]);
    }


    public function checkout()
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to access checkout');
        }

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $tax = round($subtotal * 0.05, 2);
        $shipping = 0;
        $total = $subtotal + $tax + $shipping;

        return view('checkout', compact('cart', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function contact()
    {
        return view('contacts');
    }

    public function userDashboard()
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.dashboard', compact('orders'));
    }
    public function placeOrder(Request $request)
    {
        $cart = session('cart');

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $tax = round($subtotal * 0.05, 2);
        $shipping = 0;
        $total = $subtotal + $tax + $shipping;

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD' . rand(10000, 99999),
            'subtotal' => $subtotal,
            'shipping_cost' => $shipping,
            'tax' => $tax,
            'total_amount' => $total,
            'payment_method' => $request->payment_method ?? 'cod',
            'payment_status' => 'pending',
            'order_status' => 'pending',
        ]);

        foreach ($cart as $product_id => $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.success', $order);
    }
}
