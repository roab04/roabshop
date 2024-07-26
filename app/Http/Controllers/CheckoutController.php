<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        // Lấy thông tin giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Tính tổng tiền của giỏ hàng
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Trả về view của trang thanh toán và truyền biến $cart và $total
        return view('checkout', compact('cart', 'total'));
    }

    public function processOrder(Request $request)
    {
        // Validate dữ liệu từ form thanh toán
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'total' => 'required|numeric'
        ]);

        // Lấy thông tin giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Kiểm tra xem giỏ hàng có sản phẩm không
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Tạo một đơn hàng mới
        $order = new Order();
        $order->user_id = Auth::id(); // Giả sử bạn có cột user_id để liên kết đơn hàng với người dùng
        $order->name = $request->input('name');
        $order->address = $request->input('address');
        $order->email = $request->input('email_address');
        $order->phone = $request->input('phone');
        $order->total_money = $request->input('total');
        $order->total_quantity = array_reduce($cart, function ($carry, $item) {
            return $carry + $item['quantity'];
        }, 0);
        $order->order_status = 'pending'; // Đặt trạng thái đơn hàng ban đầu
        $order->order_date = now();
        $order->save();

        // Lưu thông tin mục sản phẩm vào bảng 'order_items'
        foreach ($cart as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->save();
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công
        session()->forget('cart');

        // Chuyển hướng người dùng đến trang cảm ơn
        return redirect()->route('thank-you')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
    }

    public function thankyou()
    {
        return view('thankyou');
    }
}