<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        $soDonHang = Order::count();
        $soSanPham = Product::count();
        $soUser = User::where('role', 'user')->count();
        $doanhthu = Order::where('order_status', 'success')->sum('total_money');


        $dsDH = Order::orderBy('created_at', 'desc')->take(5)->get();
        $tkDoanhThu = Order::where('order_status', 'success')
            ->groupByRaw('YEAR(order_date), MONTH(order_date)')
            ->selectRaw('YEAR(order_date) as year, MONTH(order_date) as month, SUM(total_money) as total')
            ->get()
            ->sortBy(function($tk) {
                return $tk->year * 100 + $tk->month;
            });


        return view('admin.dashboard', compact('soDonHang', 'soSanPham', 'soUser', 'doanhthu', 'dsDH', 'tkDoanhThu'));
    }

    public function products()
    {
        $dsSP = Product::paginate(10);
        $soSanPham = Product::count();
        $soSapHet = Product::where('instock', '<=', 20)->count();
        $soDanhMuc = Category::count();
        return view('admin.products', compact('dsSP', 'soSanPham', 'soSapHet', 'soDanhMuc'));
    }

    public function users()
    {
        return view('admin.users');
    }

    public function orders()
    {
        return view('admin.orders');
    }

    public function addProduct()
    {
        $dsDanhMuc = Category::all();
        return view('admin.products_add', compact('dsDanhMuc'));
    }

    public function storeProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->description = $request->description;
        $product->instock = $request->instock;
        $product->image = '';
        $product->category_id = $request->category_id;
        $product->save();


        //upload anh
        if($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = "{$product->id}.{$img->getClientOriginalExtension()}";
            $img->move(public_path('images/'), $imgName);
            $product->image = $imgName;
            $product->save();
        }
        return redirect()->route('admin.products');

    }
    public function editProduct($id)
    {

        $sp = Product::find($id);
        $dsDanhMuc = Category::all();

        return view('admin.products_edit', compact('sp', 'dsDanhMuc'));
    }

    public function updateProduct($id)
    {
        $product = Product::find($id);
        $product->name = $_POST['name'];
        $product->price = $_POST['price'];
        $product->sale_price = $_POST['sale_price'];
        $product->description = $_POST['description'];
        $product->instock = $_POST['instock'];
        $product->image = $_POST['image'];
        $product->category_id = $_POST['category_id'];
        $product->save();
        return redirect()->route('admin.products');
    }
    public function viewProduct($id){
        $sp = Product::find($id);
        $dsDanhMuc = Category::all();
        return view('admin.products_view', compact('sp'));
    }

}