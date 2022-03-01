@extends('bakery.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('asset/css/bakery/product.css') }}">
@endsection

@section('content')
    <!-- end header -->
    <div class="banner-product">
        <div class="container-fluid">
            <div class="heading-product">
                <div class="title-product">Sản Phẩm</div>
                <a>Trang chủ</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Tìm kiếm sản phẩm</a>
            </div>

        </div>

    </div>
    <!-- end banner product -->

    <div class="products">
        <button class="icon-menu" id="iconMenu">
            <i class="fa fa-filter" aria-hidden="true"></i>
        </button>
        <div class="container">

            <h6 >Kết quả tìm kiếm từ khóa: <strong style="color:tomato">{{ $key }}</strong></h6> 

            <div class="list-product">
                <div class="row ">
                    @foreach ($product as $key => $value)
                        <div class=" col-12 col-md-4 col-lg-3 col-sm-6 p-md-3  p-3 animate__animated animate__fadeInRight"
                            style="animation-delay: 0.1s;">
                            <div class="card-product ">
                                <a href="{{ url('Bakery/San-pham/' . $value->id . '/' . $value->slug) }}">
                                    <img src="{{ asset('uploads/img/' . $value->image) }}" width="100%">
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
                                    <p class="heading-product">{{ $value->name }}</p>
                                    <div class="price-product">
                                        @if ($value->sale_price == 0)
                                            <span class="price-sale">{{ number_format($value->price) }}đ</span>
                                        @else
                                            <span class="price">{{ number_format($value->price) }}đ</span>
                                            <span class="price-sale ">{{ number_format($value->sale_price) }}đ</span>
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
                                        <a href="javascript:" onclick="AddCart({{ $value->id }})"
                                            title="Thêm vào giỏ hàng"> Thêm Vào Giỏ
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
    <!-- end product -->
@endsection

@section('js')
    <script src="{{ asset('asset/js/bakery/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/js/bakery/product.js') }}"></script>
    <script>
         function favoriteProduct(id) {
            $.ajax({

                url: `{{ asset('Bakery/Yeu-thich/${id}') }}`,
                type: "GET",
            }).done(function(response) {
                if (response) {

                    if (response.fail) {
                        alertify.warning(response.fail);
                    } else {
                        alertify.success('Đã thêm yêu thích thành công');
                    }

                    setTimeout(() => {

                        location.reload();
                    }, 1000);
                }

            });
        }
    </script>
@endsection
