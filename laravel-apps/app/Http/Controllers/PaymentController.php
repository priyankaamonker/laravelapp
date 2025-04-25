<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Binafy\LaravelCart\LaravelCart;
use Illuminate\Support\Facades\Auth;
use \Binafy\LaravelCart\Models\Cart;
use App\Models\Order;
use App\Models\OrderItems;

class PaymentController extends Controller
{
    public function checkout()
    {
        // Fetch or create the user's cart
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $ordertotal = $cart->calculatedPriceByQuantity();
        return view('checkout.index', compact('ordertotal'));
    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            // Fetch or create the user's cart
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $ordertotal = $cart->calculatedPriceByQuantity();
            Charge::create([
                'amount' => $ordertotal,
                'currency' => 'usd',
                'source' => 'tok_mastercard',// $request->stripeToken,
                'description' => 'Test Payment',
            ]);

            // create an order
            $order = new Order();
            $order->user_id = Auth::id();
            $order->total = $ordertotal;
            $order->save();
        
            // save order items
            foreach($cart['items'] as $item) {     
                $orderitems = new OrderItems();
                $orderitems->order_id = $order->getKey();
                $orderitems->itemable_id = $item['itemable_id'];
                $orderitems->quantity = $item['quantity'];
                $orderitems->itemable_price = $item->itemable->getPriceByQuantityperItem($item->quantity);
                $orderitems->save();
            }

            $cart->destroy($cart->id);
            // Payment successful; store a success message in the session
            $request->session()->flash('success', 'Payment successful!');
            return redirect()->route('payment.success');
        } catch (\Exception $e) {
            // Payment failed; store an error message in the session
            $request->session()->flash('error', $e->getMessage());
            return redirect()->route('payment.failure');
        }
    }
}
