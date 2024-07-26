@extends('layout')

@section('title', 'Trang Chủ')
@section('titlepage', 'Roab. - Trang Chủ')
@include('navbar')
@section('content')
    <div class="product-section">
        <div class="container" >
            <div class="row" >
                @foreach ($dsSP as $sp)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0 mt-5" >
                        <a class="product-item" href="{{ route('detail', ['id' => $sp->id]) }}">
                            <img src="{{ asset('/') }}images/{{ $sp->image }}" class="img-fluid product-thumbnail" >
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
