@extends('layout')

@section('title', 'Xem Đơn Hàng')
@section('titlepage', 'Roab. - Xem Đơn Hàng')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Thông tin đơn hàng #{{ $order->id }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Tên:</strong> {{ $order->name }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_money) }} VNĐ</p>
                        <!-- Thêm thông tin khác của đơn hàng nếu cần -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
