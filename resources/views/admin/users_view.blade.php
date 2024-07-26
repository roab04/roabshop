@extends('admin.layout_admin')

@section('title', 'Danh sách người dùng')

@section('body')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between">
            <h3 class="mb-4">Danh sách người dùng</h3>
        </div>
        <div>
            <a href="{{ route('admin.add-user') }}" class="btn btn-outline-secondary rounded-0">
                <i class="far fa-plus"></i> Thêm tài khoản
            </a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsUser as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}"
                                class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye fa-fw"></i> Sửa
                            </a>
                            @if ($user->is_show == 1)
                                <form action="{{ route('admin.users.hide', ['id' => $user->id]) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-warning btn-sm"
                                        onclick="return confirm('Bạn có chắc chắn muốn ẩn người dùng này?')">
                                        <i class="fas fa-eye-slash fa-fw"></i> Ẩn
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.show', ['id' => $user->id]) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-success btn-sm"
                                        onclick="return confirm('Bạn có chắc chắn muốn hiện người dùng này?')">
                                        <i class="fas fa-eye fa-fw"></i> Hiện
                                    </button>
                                </form>
                            @endif
                            @if ($user->deleted_at != null)
                            <form action="{{ route('admin.users.restore', ['id' => $user->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-success btn-sm" onclick="return confirm('Bạn có chắc chắn muốn khôi phục người dùng này?')">
                                    <i class="fas fa-undo fa-fw"></i> Khôi phục
                                </button>
                            </form>
                            @endif
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                    <i class="fas fa-trash fa-fw"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
