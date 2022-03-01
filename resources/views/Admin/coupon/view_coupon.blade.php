@extends('admin.index')


@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="{{ url('/Admin') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('Coupon.index') }}">Quản lý khuyến mãi</a></li>
            <li class="breadcrumb-item active">Khuyến mãi</li>
        </ol>

    </div>
@endsection

@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('asset/AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">

                <h3 class="text-center" style="color:tomato; padding:10px 0px">{{ $coupon->ten_ct }}</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="col">Loại chương trình:</th>
                            <td>{{ $coupon->loai_ct }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Nhóm sản phẩm áp dụng:</th>
                            <td>{{ $coupon->category->category_name }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Sản phẩm:</th>
                            <td>{{ $coupon->product->name }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Số lượng:</th>
                            <td>{{ $coupon->so_luong }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Mức giảm:</th>
                            <td>{{ $coupon->muc_giam }}</td>
                        </tr>

                        <tr>
                            <th scope="col">Mã khuyến mãi:</th>
                            <td>{{ $coupon->ma_km }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Thời gian bắt đầu:</th>
                            <td>{{ $coupon->tg_bat_dau}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Thời gian kết thúc:</th>
                            <td>{{ $coupon->tg_ket_thuc }}</td>
                        </tr>



                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


@endsection
