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

     
    </style>
@endsection

@section('content')
    <div class="banner-product">
        <div class="container-fluid">
            <div class="heading-product">
                <div class="title-product">Thông tin đơn hàng</div>
                <a>Trang chủ</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Hồ sơ cá nhân</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Thông tin đơn hàng</a>
            </div>

        </div>

    </div>
    <div class="container infor-user">
        <div class="row">
            <div class="col-12 col-lg-4 col-md-4 border-table">
                <div class="list-group list-group-flush">
                    <a href="{{ route('information_user') }}"class="list-group-item infor" >Thông tin cá nhân</a>
                    <a  href="{{ route('order') }}"class="list-group-item infor" >Thông tin đơn hàng</a>
                    <a href="{{ route('user_favorite')}}" class="list-group-item infor" >Sản phẩm yêu thích</a>
                    <a class="list-group-item infor" >Sản phẩm bình luận đánh giá</a>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-md-8">
                <div class="show">
                    <h3>Thông tin các đơn hàng</h3>
                    <table class="table">
                        <thead>
                            <tr>
                            
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Thanh toán</th>
                                <th scope="col">Tổng đơn</th>
                                <th scope="col">Ngày đặt</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($show as $key => $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>
                                        @if($value->pay == 1)
                                            <p>Ví Momo</p>
                                        @elseif($value->pay == 2)
                                            <p>Thanh toán bằng ATM</p>
                                        @elseif($value->pay == 3)
                                            <p>Thanh toán khi nhận hàng</p>
                                        @endif
                                    </td>
                                    <td>{{ $value->total }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        @if($value->status == "new")
                                            <p class="text-warning">Đang chờ xác nhận</p>
                                        @elseif($value->status == "confirm")
                                            <p class="text-success">Xác nhận đơn hàng</p>
                                        @elseif($value->status == "cancel")
                                            <p class="text-danger">Hủy đơn hàng</p>
                                        @else
                                            <p class="text-primary">Đang giao hàng</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('asset/js/bakery/owl.carousel.min.js') }}"></script>
@endsection





