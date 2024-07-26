@extends('layout')

@section('title')
    {{ $sp->name }}
@endsection
@section('content')
    <!-- Start Hero Section -->
    <div class="hero mt-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h2 class="section-title text-white">{{ $sp->name }}</h2>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Item Details -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-3">
                <img src="{{ asset('images/' . $sp->image) }}" alt="{{ $sp->name }}" class="img-fluid" style="height: 500px; width: 500px">
            </div>
            <div class="col-md-6">
                <h1>{{ $sp->name }}</h1>
                <p>{!! $sp->description !!}</p>
                <p class="lead">{{ number_format($sp->price) }}VNĐ</p>
                <p>Quantity in stock: {{ $sp->instock }}</p>
                <form action="{{ route('cart.add', $sp->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control " id="quantity" name="quantity" min="1" max="{{ $sp->instock }}" value="1"  style="width: 50px">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>

@endsection
