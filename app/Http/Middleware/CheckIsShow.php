<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIsShow
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_show == 1) {
            return $next($request);
        }
        // Nếu không thỏa mãn điều kiện, chuyển hướng về trang chủ hoặc trang lỗi
        return redirect()->route('home')->with('error', 'Tài khoản của bạn không có quyền truy cập.');
    }
}