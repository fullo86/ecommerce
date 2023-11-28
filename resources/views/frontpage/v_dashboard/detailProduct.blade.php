@extends('frontpage/layouts/main')
@section('title', 'Detail Produk')
@section('detailProductPage')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/images/product/'.$detailProduct->image_product1) }}" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('storage/images/product/'.$detailProduct->image_product2) }}" alt="Image">
                        </div>
                    
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('storage/images/product/'.$detailProduct->image_product3) }}" alt="Image">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $detailProduct->product_name }}</h3>
                    <h3 class="font-weight-semi-bold mb-4">Rp. {{ number_format($detailProduct->price, 0, ',', '.') }}</h3>
                    <p class="mb-4"> </p>
                    @if (!auth()->guard('customer')->user())
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Ukuran:</strong>
                            @foreach ($detailProduct->sizes as $size)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" value="{{ $size->id }}" id="size-{{ $size->id }}" name="selectedSize">
                                    <label class="custom-control-label" for="size-{{ $size->id }}">{{ $size->size_name }}</label>
                                </div>
                            @endforeach
                    </div>
                    @endif
                    {{-- <div class="d-flex mb-4">
                    </div> --}}
                    <div class="d-flex align-items-center mb-4 pt-2">
                        {{-- <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0  text-center" name="qty" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div> --}}
                        @if (!auth()->guard('customer')->user())
                            <button type="button" class="btn btn-primary px-3" onclick="window.location.href='/customer/login'"><i class="fa fa-shopping-cart mr-1"></i> Tambah ke Keranjang</button>
                        @else
                        <form action="/customer/cart/{{ $detailProduct->id }}" method="post">
                            @csrf
                            <div class="d-flex mb-5">
                                <strong class="text-dark mr-3">Ukuran:</strong>
                                    @foreach ($detailProduct->sizes as $size)
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" value="{{ $size->id }}" id="size-{{ $size->id }}" name="selectedSize">
                                            <label class="custom-control-label" for="size-{{ $size->id }}">{{ $size->size_name }}</label>
                                        </div>
                                    @endforeach
                            </div>        
                            <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Tambah ke Keranjang</button>
                        </form>
                        @endif        
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Deskripsi Produk</h4>
                            <p>{{ $detailProduct->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection