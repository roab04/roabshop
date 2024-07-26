@extends('layout')

@section('title', 'Cart')
@section('titlepage', 'Roab. - Cart')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero mt-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Cart</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <!-- Nội dung tùy chọn -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" action="{{ route('process.order') }}" method="POST">
                    @csrf
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is_array($cart) && !empty($cart))
                                    @foreach ($cart as $item)
                                        <tr>
                                            <td>
                                                @if (isset($item['image']))
                                                    <img src="{{ asset('images/' . $item['image']) }}"
                                                        style="height: 50px; width: 50px ">
                                                @else
                                                    <span>Null</span>
                                                @endif
                                            </td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ number_format($item['price']) }} VNĐ</td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button"
                                                            class="btn btn-outline-secondary btn-number pt-4"
                                                            data-type="minus" data-field="quantities[{{ $item['id'] }}]"
                                                            data-id="{{ $item['id'] }}">
                                                            <span class="fa fa-minus"></span>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="quantities[{{ $item['id'] }}]"
                                                        class="form-control text-center" style="width: 10px"
                                                        value="{{ $item['quantity'] }}" min="1" max="100">
                                                    <div class="input-group-append">
                                                        <button type="button"
                                                            class="btn btn-outline-secondary btn-number pt-4"
                                                            data-type="plus" data-field="quantities[{{ $item['id'] }}]"
                                                            data-id="{{ $item['id'] }}">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td id="item-total-{{ $item['id'] }}">
                                                {{ number_format($item['price'] * $item['quantity']) }} VNĐ</td>
                                            <td>
                                                <a href="{{ route('cart.remove', $item['id']) }}"
                                                    class="btn btn-danger btn-sm">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row mb-5">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <a href="{{ route('cart.clear') }}" class="btn btn-danger btn-sm btn-block">Xóa tất cả
                                        sản phẩm</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('home') }}" class="btn btn-outline-black btn-sm btn-block">Tiếp tục
                                        mua sắm</a>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <h2 class="h3 mb-3 text-black">Chi tiết hóa đơn</h2>
                                <div class="p-3 p-lg-5 border bg-white">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="name" class="text-black">Tên <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="address" class="text-black">Địa chỉ <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ Auth::user()->address }}" placeholder="Địa chỉ">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-5">
                                        <div class="col-md-6">
                                            <label for="email_address" class="text-black">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email_address"
                                                name="email_address" value="{{ Auth::user()->email }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="text-black">Số điện thoại <span
                                                    class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" id="phone" name="phone"
                                                value="{{ Auth::user()->phone }}">
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <input type="checkbox" id="agree" name="agree" required>
                                        <label class="p-2 mt-3" for="agree">
                                            <p>Tôi Đã đọc và đồng ý tất cả các điều khoản của shop</p>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-7 ">
                            <br>
                            <br>
                            <hr>
                            <div class="row justify-content-end">

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
                                                    <td class="text-black font-weight-bold"><strong>Tổng cộng</strong>
                                                    </td>
                                                    <td class="text-black font-weight-bold">
                                                        <strong>{{ number_format($total) }}
                                                            VNĐ</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <form method="POST" action="{{ route('process.order') }}">
                                            @csrf
                                            <input type="hidden" name="total" value="{{ $total }}">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Đặt
                                                    hàng</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Button plus and minus functionality
    document.querySelectorAll('.btn-number').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const fieldName = this.getAttribute('data-field');
            const type = this.getAttribute('data-type');
            const id = this.getAttribute('data-id');
            const input = document.querySelector("input[name='" + fieldName + "']");
            let currentValue = parseInt(input.value);

            if (!isNaN(currentValue)) {
                if (type === 'minus' && currentValue > parseInt(input.min)) {
                    input.value = currentValue - 1;
                    currentValue--;
                } else if (type === 'plus' && currentValue < parseInt(input.max)) {
                    input.value = currentValue + 1;
                    currentValue++;
                }
            } else {
                input.value = 1;
                currentValue = 1;
            }

            // AJAX request to update cart
            fetch("{{ route('cart.update-item') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id: id,
                        quantity: currentValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("item-total-" + id).innerText = data.item_total + "VNĐ";
                    document.getElementById("cart-total").innerText = data.total + "VNĐ";
                })
                .catch(error => console.error('Error:', error));
            location.reload();
        });
    });
});
    </script>
@endsection
