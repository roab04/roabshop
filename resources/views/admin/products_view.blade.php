@extends('admin.layout_admin')

@session('title')
    Xem sản phẩm
@endsession

@section('body')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between">
            <h3 class="mb-4">Xem sản phẩm "{{ $sp->name }}"</h3>
            <div>
                <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary rounded-0">
                    <i class="far fa-long-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <form class="row" action="" method="POST"
            enctype="multipart/form-data">
            <div class="col-md-8 mb-4">
                <div class="card rounded-0 border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="pb-3 border-bottom">Thông tin sản phẩm</h6>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control rounded-0" id="name" required
                                value="{{ $sp->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control rounded-0" id="description" rows="6">{!! $sp->description !!}</textarea>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="instock" class="form-label">Instock *</label>
                                <input type="number" class="form-control rounded-0" id="instock" min="0" required
                                    value="{{ $sp->instock }}">
                            </div>
                            <div class="col mb-3">
                                <label for="category" class="form-label">Category *</label>
                                <input type="text" class="form-control rounded-0" id="name" required
                                value="{{ $sp->category->name }}">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card rounded-0 border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="pb-3 border-bottom">Price</h6>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="price" class="form-label">Price *</label>
                                <input type="number" class="form-control rounded-0" id="price" min="0" required
                                    value="{{ $sp->price }}">
                            </div>
                            <div class="col mb-3">
                                <label for="sale_price" class="form-label">Sale Price</label>
                                <input type="number" class="form-control rounded-0" id="sale_price" min="0"
                                    value="{{ $sp->sale_price }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card rounded-0 border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="pb-3 border-bottom">Image</h6>
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image *</label>
                            <div class="bg-secondary-subtle mb-3 p-2 text-center">
                                <img src="{{ asset('images/' . $sp->image) }}" class="w-50">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
