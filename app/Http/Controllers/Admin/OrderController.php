<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Phương thức để hiển thị danh sách hóa đơn
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders_view', compact('orders'));
    }

    // Phương thức để hiển thị chi tiết hóa đơn
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders_detail', compact('order'));
    }
    public function updateOrderStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->order_status = $request->order_status;
    $order->save();

    return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
}


}
