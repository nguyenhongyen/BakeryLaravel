@extends('bakery.index')
@section('css')
    <link rel="stylesheet" href="{{ asset('asset/css/bakery/cart.css') }}">
@endsection
@section('content')
    <div class="banner-product">
        <div class="container-fluid">
            <div class="heading-product">
                <div class="title-product">Giỏ hàng</div>
                <a>Trang chủ</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Giỏ hàng</a>
            </div>

        </div>

    </div>
    <!-- end banner product -->
    <div class="table-product">
        <div class="container">

            <table class="table">
                <thead>
                    <tr class="header-table">
                        <th scope="col-2">Hình ảnh</th>
                        <th scope="col-2">Tên sản phẩm</th>
                        <th scope="col-2">Số lượng</th>
                        <th scope="col-2">Giá bán</th>
                        <th scope="col-2" colspan="2">Tổng giá</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $key => $item)
                        <tr class="item-table">
                            <td><img src="{{ asset('uploads/img/' . $item->options->image) }}" width="90px" height="80px">
                            </td>
                            <td class="name-item-product">{{ $item->name }}</td>
                            <td>
                                <div class="quantity">
                                    <button class="btn-dec" type="button">-</button>
                                    <input type="text" id="qty-{{ $key }}" name="quantity"
                                        value="{{ $item->qty }}" min="1" max="50">
                                    <button class="btn-inc " type="button">+</button>
                                </div>
                            </td>
                            <td class="price-product">{{ number_format($item->price) }}</td>
                            <td id="price">{{ number_format($item->price * $item->qty) }}</td>
                            <td>
                                <a onclick="SaveCart('{{ $key }}')">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                </a>

                            </td>
                            <td class="icon-delete">
                                <a href="javasvript:" onclick="DeleteCart('{{ $key }}')"><i class="fa fa-times"
                                        aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    <tr class="item-total">
                        <td colspan="4" class="title-total">Tổng cộng:</td>
                        <td colspan="3" class="title-price">{{ Cart::subtotal(0) }} vnđ</td>

                    </tr>
                    <tr class="item-total">
                        <td colspan="7"></td>
                    </tr>
                </tbody>

            </table>
            <!-- end table -->
            @foreach (Cart::content() as $key => $item)
                <div class="card-item-product">
                    <img src="{{ asset('uploads/img/' . $item->options->image) }}" width="90px" height="80px">
                    <a href="javasvript:" onclick="DeleteCart('{{ $key }}')"><i class="fa fa-times"
                            aria-hidden="true"></i></a>
                    <div class="item-product">
                        <div class="title-product">Sản phẩm:</div>
                        <div class="name-product">{{ $item->name }}</div>
                    </div>
                    <div class="item-product">
                        <div class="title-product">Giá bán:</div>
                        <div class="price-product">{{ number_format($item->price) }}</div>
                    </div>
                    <div class="item-product">
                        <div class="title-product">Số lượng:</div>
                        <div class="text-product">
                            <div class="quantity">
                                <button class="btn-dec " type="button">-</button>
                                <input type="text" id="qty-{{ $key }}" name="quantity"
                                    value="{{ $item->qty }}">
                                <button class="btn-inc " type="button">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="item-product">
                        <div class="title-product">Cập nhật</div>
                        <div class="text-product">
                            <a onclick="SaveCart('{{ $key }}')" style="position: initial;">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="item-product">
                        <div class="title-product title-price-product">Tổng:</div>
                        <div class="price-product">{{ number_format($item->price * $item->qty) }} vnđ</div>
                    </div>
                </div>
            @endforeach
            <!-- end card -->
            <div class="discount">
                <input type="text" name="discount" id="discount" placeholder="Nhập mã giảm giá">
                <button type="button" class="btn btn-discount">Mã giảm giá</button>
            </div>
            <div class="row justify-content-end">
                <div class="col-12 col-lg-4 col-md-7">
                    <div class="total-bill">
                        <div class="list-bill">
                            <p class="title-bill">Tổng cộng:</p>
                            <p class="price-bill">{{ Cart::subtotal(0) }} vnđ</p>
                        </div>
                        <div class="list-bill">
                            <p class="title-bill">Giảm giá:</p>
                            <p class="price-bill">-10.000 đ</p>
                        </div>
                        <div class="list-bill">
                            <p class="title-bill">Tổng tiền:</p>
                            <p class="price-bill">{{ Cart::subtotal(0) }} vnđ</p>
                        </div>
                        <div class="payment">
                            @if(Auth::check())
                            <a href="{{ route('pay_bill') }}">
                                <p>TIẾN HÀNH THANH TOÁN</p>
                            </a>
                            @else
                                <a href="" data-toggle="modal" data-target="#thongbao">
                                    <p>TIẾN HÀNH THANH TOÁN</p>
                                </a>
                                <div class="modal fade" id="thongbao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                        <div class="modal-body">
                                          Vui lòng đăng nhập để thanh toán đơn hàng!!!
                                        </div>
                                        <div class="modal-footer">
                                         
                                          <button type="button" class="btn " style="background-color: tomato;color:white;" data-dismiss="modal">Chấp nhận</button>
                                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('asset/js/bakery/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/js/bakery/cart.js') }}"></script>
    <script>
        function DeleteCart(id) {
            $.ajax({

                url: `{{ asset('Bakery/Delete-cart/${id}') }}`,
                type: "GET",
            }).done(function(response) {
                console.log(response);
                if (response) {
                    alertify.success('Đã xóa thành công');
                    setTimeout(() => {

                        location.reload();
                    }, 1000);

                }
            });
        }

        function SaveCart(id) {
            const qty = document.querySelector('#qty-' + id).value;

            console.log(qty);
            $.ajax({
                url: `{{ asset('Bakery/Save-cart/${id}/${qty}') }}`,
                type: "GET",
            }).done(function(response) {
                console.log(response);

                if (response) {
                    alertify.success("Đã cập nhật đơn hàng!");
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            });

        }
    </script>
@endsection
