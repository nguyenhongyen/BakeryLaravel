@extends('bakery.index')

@section('content')
    <div class="banner">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('asset/img/Image/banner-3.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption banner1 d-none d-md-block d-sm-block">
                        <h1 class=" animate__animated animate__zoomIn">Giảm 50% - Nhân dịp sinh nhật lần thứ 2</h1>
                        <p class=" animate__animated animate__zoomIn">Áp dụng trên toàn hệ thống</p>
                        <a href="{{ route('product') }}" type="button" class="btn btn-danger btn-lg">Xem ngay</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('asset/img/Image/banner-1.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption banner2 d-none d-md-block">
                        <h1 class="animate__animated animate__slideInDown">Giảm <span>50%</span> - Nhân dịp Giáng sinh </h1>
                        <p class="animate__animated animate__zoomInDown">Áp dụng từ ngày 24-25/12/2021</p>
                        <a href="{{ route('product') }}" type="button" class="btn btn-danger btn-lg">Xem ngay</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('asset/img/Image/banner-8.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption banner3 d-none d-md-block">
                        <h1 class="animate__animated animate__zoomIn">Ra mắt món mới - <span> Bánh mì hoa cúc</span></h1>
                        <p class="animate__animated animate__slideInRight">Khách hàng sẽ được thử món mới khi mua trực tiếp
                            tại cửa hàng</p>
                        <a href="{{ route('product') }}" type="button" class="btn btn-danger btn-lg">Xem ngay</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>

    </div>
    <!-- end banner -->
    <div class="image-cake">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 mt-4">
                    <div class="card text-white card-left">
                        <img src="{{ asset('asset/img/Image/a1.jpg') }}" class="card-img" alt="..." height=500;>
                        <div class="card-img-overlay">
                            <p class="card-title ">Bánh Tiramisu đặt nhiều nhất</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 col-12 image-cake-right">
                                <div class="image-cake-right-info">
                                    <span class="title-discount">Bánh Cake</span>
                                    <span class="discount">50%</span>
                                </div>
                                <div class="card text-white">
                                    <img src="{{ asset('asset/img/Image/a2.jpg') }}" class="card-img" alt="..."
                                        height="270">
                                </div>

                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-6  p-2">
                                <img src="{{ asset('asset/img/Image/a3.jpg') }}" class="card-img image-right"
                                    height="200">
                            </div>
                            <div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-6 p-2">
                                <img src="{{ asset('asset/img/Image/a4.jpg') }}" class="card-img image-right"
                                    height="200">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end image-cake -->
    <div class="product">
        <div class="container">
            <div class="text-center title-product">Bánh Ngon Hôm Nay</div>
            <hr class="icon-line">
            <div class="row">
                @foreach ($product_today as $key => $value)
                    <div class="col-10 col-md-4 col-lg-3 col-sm-6 p-3">
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
    <!-- end product -->
    <div class="order">
        <div class="container-fluid">
            <div class="text-center title-order">Đặt Hàng Trong Ba Bước</div>
            <hr class="icon-line">
            <div class="icon-order">
                <div class="container">
                    <div class="row justify-content-xl-center justify-content-lg-center justify-content-md-center">
                        <div class="col col-xl-2 col-lg-2 col-md-3 col-sm-4 mr-xl-5 mr-lg-5 icon-order-item">
                            <img src="{{ asset('asset/img/Image/home-icon.svg') }}" class="card-img">
                            <p class="text-center">Chọn Nhà Hàng</p>
                        </div>
                        <div class="col col-xl-2 col-lg-2 col-md-3 col-sm-4 mr-xl-5 mr-lg-5 icon-order-item">
                            <img src="{{ asset('asset/img/Image/select-icon.svg') }}" class="card-img">
                            <p class="text-center">Chọn Bánh</p>
                        </div>
                        <div class="col col-xl-2 col-lg-2 col-md-3 col-sm-4 mr-xl-5 mr-lg-5 icon-order-item">
                            <img src="{{ asset('asset/img/Image/car-icon.svg') }}" class="card-img">
                            <p class="text-center">Giao Hàng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end order -->
        <div class="feature"></div>
        <!-- end feature -->
        <div class="infor"></div>
        <!-- end infor -->
        <div class="blog"></div>
        <!-- end blog -->
        <div class="footer"></div>
        <!-- end footer -->
    </div>
    <!-- end order -->
    <div class="slider">
        <div class="container">
            <h1 class="text-center">Bánh Mới</h1>
            <hr class="icon-line">
            <div class="owl-carousel owl-theme">
                @foreach ($product_new as $key => $value)
                    <div class="item">
                        <div class="col-12">
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
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- end slider -->
    <div class="counter">
        <div class="container-fluid">
            <div class=" row  justify-content-lg-center  justify-content-md-center">
                <div
                    class="row-counter col-3 col-xl-2 col-lg-2 col-md-2 col-sm-3 p-xl-5 pt-lg-5 pt-md-5 pt-sm-5 mb-3 pt-5">
                    <img src="{{ asset('asset/img/Image/icon-1.png') }}" class="card-img">
                    <p class="counter-number">250</p>
                    <p>Món Ngon</p>
                </div>
                <div
                    class="row-counter col-3 col-xl-2 col-lg-2 col-md-2 col-sm-3 p-xl-5 pt-lg-5 pt-md-5 pt-sm-5 mb-3 pt-5">
                    <img src="{{ asset('asset/img/Image/icon-2.png') }}" class="card-img ">
                    <p class="counter-number">20+</p>
                    <p>Năm Kinh Nghiệm</p>
                </div>
                <div
                    class="row-counter col-3 col-xl-2 col-lg-2 col-md-2 col-sm-3 p-xl-5 pt-lg-5 pt-md-5 pt-sm-5 mb-3 pt-5 ">
                    <img src="{{ asset('asset/img/Image/icon-3.png') }}" class="card-img">
                    <p class="counter-number">2000+</p>
                    <p>Khách Hàng</p>
                </div>
                <div
                    class="row-counter col-3 col-xl-2 col-lg-2 col-md-2 col-sm-3 p-xl-5 pt-lg-5 pt-md-5 pt-sm-5 mb-3 pt-5 ">
                    <img src="{{ asset('asset/img/Image/icon-4.png') }}" class="card-img">
                    <p class="counter-number">20</p>
                    <p>Giải Thưởng</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end counter -->
    <div class="blog">
        <div class="container">
            <div class="title-blog text-center">Tin tức mới nhất</div>
            <hr class="icon-line">
            <div class="row justify-content-md-center pt-4">
                @foreach ($blog as $key => $value)
                    <div class=" col-12 col-lg-6 col-md-5 col-sm-6 p-3 animate__animated animate__fadeInLeft">
                        <div class="container blog-row">
                            <div class="row ">
                                <div class="col-lg-6 p-2">
                                    <a href="{{ url('Bakery/Blog/' . $value->id . '/' . $value->slug_blog) }}">
                                        <img src="{{ asset('uploads/img/' . $value->img_blog) }}" alt="Image"
                                            width="100%" height="100%">
                                    </a>
                                </div>
                                <div class="col-lg-6 card-body">
                                    <a href="{{ url('Bakery/Blog/' . $value->id . '/' . $value->slug_blog) }}">
                                        <div class="blog-title">{{ $value->name_blog }}</div>
                                        <div class="blog-date">
                                            <i class="fa fa-user" aria-hidden="true"></i> Admin |
                                            <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $value->created_at }}
                                        </div>
                                        <div class="blog-content">
                                            <p>{{ $value->synopsis_blog }}</p>
                                        </div>
                                        <a class="btn btn-danger"
                                            href="{{ url('Bakery/Blog/' . $value->id . '/' . $value->slug_blog) }}"
                                            role="button">Xem thêm</a>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end blog -->
@endsection

@section('js')
    <script src="{{ asset('asset/js/bakery/owl.carousel.min.js') }}"></script>
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
