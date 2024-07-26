<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
class CartController extends Controller
{


    public function index()
{
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Lấy thông tin giỏ hàng từ session
    $cart = session()->get('cart', []);

    // Tính tổng tiền của giỏ hàng
    $total = array_reduce($cart, function ($carry, $item) {
        return $carry + $item['price'] * $item['quantity'];
    }, 0);

    // Trả về view của trang giỏ hàng và truyền biến $cart và $total
    return view('cart', compact('cart', 'total'));
}
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1);

        // Thêm sản phẩm vào giỏ hàng
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'image' => $product->image,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }

    public function updateItem(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');
        $quantity = $request->input('quantity');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + $item['price'] * $item['quantity'];
        }, 0);

        return response()->json([
            'total' => $total,
            'item_total' => number_format($cart[$id]['price'] * $cart[$id]['quantity']),
        ]);
    }
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Giỏ hàng đã được xóa!');
    }
}