<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;

class UsersController extends Controller
{

    public function users()
    {
        $dsUser = User::paginate(10);
        return view('admin.users_view', compact('dsUser'));
    }
    public function addUser()
    {
        return view('admin.users_add');
    }

    public function storeUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->save();
        return redirect()->route('admin.users');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users_edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Tài khoản đã được cập nhật thành công');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Tài khoản đã được xóa thành công');
    }
    public function restoreUser($id)
    {
        $user = User::withTrashed()->find($id);

        if ($user) {
            $user->restore();
            return redirect()->route('admin.users')->with('success', 'Người dùng đã được khôi phục thành công!');
        } else {
            return redirect()->route('admin.users')->with('error', 'Không tìm thấy người dùng để khôi phục!');
        }
    }
    public function hideUser($id)
{
    // Tìm người dùng theo ID
    $user = User::findOrFail($id);

    // Cập nhật giá trị của is_show thành 0 (đã ẩn)
    $user->is_show = 0;
    $user->save();

    // Chuyển hướng trở lại trang danh sách người dùng
    return redirect()->route('admin.users')->with('success', 'Người dùng đã được ẩn.');
}
    public function showUser($id)
    {
        // Tìm người dùng theo ID
        $user = User::findOrFail($id);

        // Cập nhật giá trị của is_show thành 1 (đã hiện)
        $user->is_show = 1;
        $user->save();

        // Chuyển hướng trở lại trang danh sách người dùng
        return redirect()->route('admin.users')->with('success', 'Người dùng đã được hiển thị.');
    }
}