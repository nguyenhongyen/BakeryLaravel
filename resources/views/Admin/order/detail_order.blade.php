@extends('admin.index')


@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="{{ url('/Admin') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('Order.order') }}">Quản lý đơn hàng</a></li>
            <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
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

                <h3 class="text-center p-4">Chi tiết đơn hàng: <span
                        style="color:tomato; padding:10px 0px"> {{ $order->user->name }} - {{ $order->id }}</span> </h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                        </tr>
                        @foreach ($detail_order as $key => $value)
                            <tr>

                                <td>{{ $value->product->name }}</td>
                                <td>{{ $value->quantity }}</td>
                                <td>{{ $value->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <h5 class="p-2"><strong>Ghi chú:</strong> {{ $order->note }}</h5>

            </div>
        </div>
    </div>
</div>


@endsection
