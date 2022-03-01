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
                <div class="title-product">Liên hệ</div>
                <a>Trang chủ</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Hồ sơ cá nhân</a>
            </div>

        </div>

    </div>
    <div class="container infor-user">
        <div class="row">
            <div class="col-12 col-lg-4 col-md-4 border-table">
                <div class="list-group list-group-flush">
                    <a href="{{ route('information_user') }}"class="list-group-item infor" value='1'>Thông tin cá nhân</a>
                    <a  href="{{ route('order') }}"class="list-group-item infor" value='2'>Thông tin đơn hàng</a>
                    <a href="{{ route('user_favorite') }}"class="list-group-item infor" value='3'>Sản phẩm yêu thích</a>
                    <a class="list-group-item infor" value='4'>Sản phẩm bình luận đánh giá</a>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-md-8">
                <div id="show-user"></div>

                <div class="show">
                    <h3> Thông tin cá nhân</h3>
                    <div class="item">
                        <p>Họ tên:</p>
                        <p>{{ Auth::user()->name }}</p>
                    </div>
                    <div class="item">
                        <p>Email:</p>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <div class="item">
                        <p>Số điện thoại:</p>
                        <p>048999333</p>
                    </div>
                    <div class="item">
                        <p>Ngày sinh:</p>
                        <p>25/7/3000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('asset/js/bakery/owl.carousel.min.js') }}"></script>
@endsection
