@extends('admin.layout_admin')

@section('title', 'Thêm tài khoản')

@section('body')
    <h3 class="mb-4">Thêm tài khoản</h3>
    <div>
        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary rounded-0">
            <i class="far fa-long-arrow-left"></i> Back
        </a>
    </div>
    <form class="row" action="{{ route('admin.store-user') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-8 mb-4">
            <div class="card rounded-0 border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="pb-3 border-bottom">Thông tin</h6>
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên *</label>
                        <input type="text" class="form-control rounded-0" id="name" required name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control rounded-0" id="email" required name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu *</label>
                        <input type="password" class="form-control rounded-0" id="password" required name="password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu *</label>
                        <input type="password" class="form-control rounded-0" id="password_confirmation" required name="password_confirmation">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại *</label>
                        <input type="text" class="form-control rounded-0" id="phone" required name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ *</label>
                        <input type="text" class="form-control rounded-0" id="address" required name="address">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Vai trò *</label>
                        <select class="form-select rounded-0" id="role" required name="role">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg rounded-0 mt-4 w-100">Tạo Tài Khoản</button>
        </div>
    </form>
@endsection
