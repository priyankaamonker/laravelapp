<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $myorders = Order::where('user_id', Auth::id())->get();
        
        $orders = array();
        $i = 0;
        foreach($myorders as $order) {
            $orders[$i]['id'] = $order->id;
            $orders[$i]['user_id'] = $order->user_id;
            $orders[$i]['total'] = $order->total;
            $orders[$i]['created_at'] = $order->created_at;
            $orderitems = OrderItems::where('order_id', $order->id)->get();
            $j = 0;
            foreach($orderitems as $orderitem) {
                $orders[$i]['item'][$j]['quantity'] = $orderitem->quantity;
                $orders[$i]['item'][$j]['itemable_price'] = $orderitem->itemable_price;
                $item = Product::where('id', $orderitem->itemable_id)->get();
                $orders[$i]['item'][$j]['image'] = $item[0]['image'];
                $orders[$i]['item'][$j]['name'] = $item[0]['name'];
                $j++;
            }
            $i++;
        }
        return view('orders.index', compact('orders'));
    }
}
