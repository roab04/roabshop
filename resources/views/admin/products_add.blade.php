@extends('admin.layout_admin')

@session('title')
    Thêm Sản phẩm
@endsession

@section('body')
    <h3 class="mb-4">Add Product</h3>
    <div>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary rounded-0">
            <i class="far fa-long-arrow-left"></i> Back
        </a>
    </div>
    <form class="row" action="{{route('admin.store-product')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-8 mb-4">
            <div class="card rounded-0 border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="pb-3 border-bottom">Basic Info</h6>
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên Sản Phẩm *</label>
                        <input type="text" class="form-control rounded-0" id="name" required name="name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control rounded-0" id="description" rows="6" name="description"></textarea>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="instock" class="form-label">Instock *</label>
                            <input type="number" class="form-control rounded-0" id="instock" min="0" required name="instock">
                        </div>
                        <div class="col mb-3">
                            <label for="category" class="form-label">Category ID *</label>
                            <div class="input-group">
                                <select class="form-select rounded-0" id="category" required name="category_id">
                                    @foreach ($dsDanhMuc as  $dm)
                                        <option value="{{ $dm->id }}">{{ $dm->name }}</option>
                                    @endforeach
                                </select>
                                {{-- <button type="button" class="btn btn-outline-primary rounded-0">
                                    <i class="fal fa-boxes"></i>
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card rounded-0 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="pb-3 border-bottom">Giá</h6>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="price" class="form-label">Price *</label>
                            <input type="number" class="form-control rounded-0" id="price" min="0" required name="price">
                        </div>
                        <div class="col mb-3">
                            <label for="sale_price" class="form-label">Giá Giảm</label>
                            <input type="number" class="form-control rounded-0" id="sale_price" min="0" name="sale_price">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card rounded-0 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="pb-3 border-bottom">Ảnh</h6>
                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh sản phẩm *</label>
                        <input class="form-control rounded-0" type="file" id="image" required name="image">
                        <div class="bg-secondary-subtle mb-3 p-2 text-center">
                            <img src="assets/img/products/iphone.webp" class="w-50">
                        </div>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg rounded-0 mt-4 w-100">Tạo Sản Phẩm</button>
        </div>
    </form>
@endsection
@section('script')
<script>
    var imgIpn = document.getElementById('image');
    imgIpn.onchange = env => {
        const [file] = imgIpn.files
        if(file){
            document.querySelector('#image+div img').src = URL.createObjectURL(file);
        }
    }
</script>
@endsection
