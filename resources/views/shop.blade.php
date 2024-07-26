@extends('layout')

@section('title', 'Shop')
@section('titlepage', 'Roab. - Shop')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero mt-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Shop</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->


    <div class="product-section">
        <div class="container">
            <div class="row">
                @foreach ($dsSP as $sp)

                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0 mt-5">
                        <a class="product-item" href="{{ route('detail', ['id' => $sp->id]) }}">
                            <img src="{{ asset('/') }}images/{{ $sp->image }}" class="img-fluid product-thumbnail">
                            <h3 class="product-title">
                                {{ $sp->name }}
                            </h3>
                            <strong class="price">
                                @if (isset($sp->sale_price))
                                    {{-- <del>{{ number_format($sp->price) }}VNĐ</del><br> --}}
                                    <span>{{ number_format($sp->sale_price) }}VNĐ</span>
                                @else
                                    <span>{{ number_format($sp->price) }}VNĐ</span>
                                @endif
                            </strong>

                            <span class="icon-cross">
                                <img src="images/cross.svg" class="">
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
