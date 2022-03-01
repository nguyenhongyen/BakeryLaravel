@extends('bakery.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('asset/css/bakery/checkout.css') }}">
@endsection

@section('content')
    <div class="banner-product">
        <div class="container-fluid">
            <div class="heading-product">
                <div class="title-product">Thanh toán</div>
                <a>Trang chủ</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Giỏ hàng</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Thanh toán</a>
            </div>

        </div>

    </div>
    <!-- end banner product -->
    <div class="check-out">
        <div class="conteiner">
            <form method="POST" action="{{ route('bill') }}">
                @csrf
                <div class="row justify-content-lg-center justify-content-md-center">
                    <div class="col-12 col-xl-6 col-lg-6 col-md-10 col-sm-12">
                        <div class="inf-left">
                            @if(Auth::check())
                            <p class="title-checkout">Thông tin người nhận</p>
                            <div class="form-group">
                                <label for="name">Họ tên</label>
                                <input type="text" name="name" id="name" value="{{Auth::user()->name  }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{Auth::user()->email  }}" disabled>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ giao hàng</label>
                                <input type="text" id="address" name="address">
                            </div>
                            <div class="form-group">
                                <label for="note">Ghi chú thêm</label>
                                <textarea id="note" rows="4" name="note"></textarea>
                            </div>

                        </div>

                    </div>
                    <div class=" col-12 col-xl-5 col-lg-6 col-md-8 col-sm-12">
                        <div class="inf-right">
                            <div class="header-right">
                                <div class="title-checkout">Đơn hàng của tôi</div>
                                <!-- <hr class="height-checkout"> -->
                            </div>
                            <div class="bill">
                                @foreach (Cart::content() as $key => $item)
                                <div class="item-bill">
                                    <p class="name-product">{{ $item->name }} x {{ $item->qty }}</p>
                                    <p class="price-product">{{ number_format($item->price) }} đ</p>
                                </div>
                                @endforeach
                                <div class="total-bill-pay">
                                    <p class="name-product">Tổng cộng</p>
                                    <p class="price-product">{{ Cart::subtotal(0) }} đ</p>
                                </div>
                               
                            </div>
                            <div class="header-right">
                                <div class="title-checkout">Phương thức thanh toán</div>
                                <!-- <hr class="height-checkout"> -->
                            </div>
                            <div class="item-pay">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pay" id="exampleRadios1"
                                        value="1" >
                                    <label class="form-check-label" for="exampleRadios1">
                                        Ví Momo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pay" id="exampleRadios1"
                                        value="2" >
                                    <label class="form-check-label" for="exampleRadios1">
                                        Thanh toán bằng ATM
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pay" id="exampleRadios1"
                                        value="3" >
                                    <label class="form-check-label" for="exampleRadios1">
                                        Thanh toán khi nhận hàng
                                    </label>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-checkout">Thanh toán</button>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('asset/js/bakery/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/js/bakery/cart.js') }}"></script>
@endsection
