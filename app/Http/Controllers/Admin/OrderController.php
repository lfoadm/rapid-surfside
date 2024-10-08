<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItem;
use App\Models\Admin\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(12);
        return view('admin.orders.orders', compact('orders'));
    }

    public function order_show($order_id)
    {
        $order = Order::find($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(12);
        $transaction = Transaction::where('order_id', $order_id)->first();
        return view('admin.orders.order-show', compact('order', 'orderItems', 'transaction'));   
    }

    public function update_order_status(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = $request->order_status;
        
        if($request->order_status == 'delivered')
        {
            $order->delivered_date = Carbon::now();
        }
        elseif($request->order_status == 'canceled')
        {
            $order->canceled_date = Carbon::now();
        }
        $order->save();

        if($request->order_status == 'delivered')
        {
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            $transaction->status = 'approved';
            $transaction->save();
        }
        return back()->with('status', "Status modificado com sucesso!");
    }

}
