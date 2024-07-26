@extends('layout')

@section('title', 'Thanh toán')
@section('titlepage', 'Roab. - Thanh toán')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero mt-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Thanh toán</h1>
                    </div>
                </div>
                <div class="col-lg-7"></div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                <form method="POST" action="{{ route('process.order') }}">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Chi tiết hóa đơn</h2>
                        <div class="p-3 p-lg-5 border bg-white">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="name" class="text-black">Tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="address" class="text-black">Địa chỉ <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Địa chỉ">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label for="email_address" class="text-black">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email_address" name="email_address">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="text-black">Số điện thoại <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        placeholder="+84">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c_order_notes" class="text-black">Ghi chú đơn hàng</label>
                                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                                    placeholder="Nhập ghi chú của bạn ở đây..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Đơn hàng của bạn</h2>
                                <div class="p-3 p-lg-5 border bg-white">
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $item)
                                                <tr>
                                                    <td>{{ $item['name'] }} <strong class="mx-2">x</strong>
                                                        {{ $item['quantity'] }}</td>
                                                    <td>{{ number_format($item['price'] * $item['quantity']) }} VNĐ
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Tổng cộng</strong></td>
                                                <td class="text-black font-weight-bold"><strong>{{ number_format($total) }}
                                                        VNĐ</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    @csrf
                                    <input type="hidden" name="total" value="{{ $total }}">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Đặt
                                            hàng</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
