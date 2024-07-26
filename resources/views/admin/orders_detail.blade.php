@extends('admin.layout_admin')

@section('title', 'Chi tiết hóa đơn')

@section('body')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between">
            <h3 class="mb-4">Chi tiết hóa đơn #{{ $order->id }}</h3>
            <div>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary rounded-0">
                    <i class="far fa-long-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card rounded-0 border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="pb-3 border-bottom">Thông tin khách hàng</h6>
                <p><strong>Tên:</strong> {{ $order->name }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
            </div>
        </div>
        <div class="card rounded-0 border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="pb-3 border-bottom">Chi tiết đơn hàng</h6>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price) }} VNĐ</td>
                                <td>{{ number_format($item->price * $item->quantity) }} VNĐ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="text-right"><strong>Tổng cộng:</strong> {{ number_format($order->total_money) }} VNĐ</p>
            </div>
        </div>
    </div>
@endsection
