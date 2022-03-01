@extends('bakery.index')
@section('css')
    <link rel="stylesheet" href="{{ asset('asset/css/bakery/contact.css') }}">
    <style>
        .border-table {
            border-right: 4px solid tomato;
        }

        .infor-user {
            padding: 30px 0px;
            font-size: 18px;
        }
        a{
            text-decoration: none;
            color:black;
        }
        a:hover{
            text-decoration: none;
            color:tomato;
        }
        h3 {
            color: tomato;
            text-align: center;
            padding-bottom: 10px;
        }

        .show {
            padding: 10px 0px;

        }

        .item {

            display: flex;
        }

        .item p {
            margin-left: 8px;
        }

    </style>
@endsection

@section('content')
    <div class="banner-product">
        <div class="container-fluid">
            <div class="heading-product">
                <div class="title-product">Sản phẩm yêu thích</div>
                <a>Trang chủ</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Hồ sơ cá nhân</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Sản phẩm yêu thích</a>
            </div>

        </div>

    </div>
    <div class="container infor-user">
        <div class="row">
            <div class="col-12 col-lg-4 col-md-4 border-table">
                <div class="list-group list-group-flush">
                    <a href="{{ route('information_user') }}"class="list-group-item infor" value='1'>Thông tin cá nhân</a>
                    <a  href="{{ route('order') }}"class="list-group-item infor" value='2'>Thông tin đơn hàng</a>
                    <a href="{{ route('user_favorite')}}" class="list-group-item infor" value='3'>Sản phẩm yêu thích</a>
                    <a class="list-group-item infor" value='4'>Sản phẩm bình luận đánh giá</a>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-md-8">
                <div class="show">
                    <h3>Sản phẩm yêu thích</h3>
                    <div class="row">
                        @foreach ($product as $key => $value)
                            <div class="col-10 col-md-4 col-lg-4 col-sm-6 p-3">
                                <div class="card-product ">
        
                                    <a href="{{ url('Bakery/San-pham/' . $value->id . '/' .$value->slug) }}">
                                        <img src="{{ asset('uploads/img/' . $value->product->image) }}" width="100%">
        
                                        @if ($value->sale_price > 0)
                                            <div class="sale">
                                                {{ $value->percent_sale }}
                                            </div>
                                        @endif
                                        <div class="favorite">
                                            <a href="#" onclick="favoriteProduct({{ $value->id }})" style="color:red">
                                                <i class="{{ $value->like ? 'fa fa-heart' : 'fa fa-heart-o text-dark' }}"
                                                    aria-hidden="true" title="Yêu thích"></i>
                                            </a>
                                        </div>
                                    </a>
        
                                    <div class="content-product">
                                        <p class="heading-product">{{ $value->product->name }}</p>
                                        <div class="price-product">
                                            @if ($value->sale_price == 0)
                                                <span class="price-sale">{{ number_format($value->product->price) }}đ</span>
                                            @else
                                                <span class="price">{{ number_format($value->product->price) }}đ</span>
                                                <span class="price-sale ">{{ number_format($value->product->sale_price) }}đ</span>
                                            @endif
                                        </div>
                                        <div class="rate-product">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <div class="order-product">
                                            <a href="javascript:" onclick="AddCart({{ $value->id }})" title="Thêm vào giỏ hàng">
                                                Thêm Vào Giỏ
                                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
        
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('asset/js/bakery/owl.carousel.min.js') }}"></script>
@endsection
