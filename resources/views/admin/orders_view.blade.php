@extends('admin.layout_admin')

@section('title', 'Danh sách hóa đơn')

@section('body')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between">
            <h3 class="mb-4">Danh sách hóa đơn</h3>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ number_format($order->total_money) }} VNĐ</td>
                        <td>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="order_status" onchange="this.form.submit()" class="form-control">
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirm" {{ $order->order_status == 'confirm' ? 'selected' : '' }}>Confirm</option>
                                    <option value="delivering" {{ $order->order_status == 'delivering' ? 'selected' : '' }}>Delivering</option>
                                    <option value="success" {{ $order->order_status == 'success' ? 'selected' : '' }}>Success</option>
                                    <option value="cancel" {{ $order->order_status == 'cancel' ? 'selected' : '' }}>Cancel</option>
                                </select>
                            </form>
                        </td>
                        <td>{{ $order->order_date }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-eye fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
