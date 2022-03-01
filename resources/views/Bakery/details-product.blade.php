@extends('bakery.index')
@section('css')
    <link rel="stylesheet" href="{{ asset('asset/css/bakery/details-product.css') }}">
    <style>
        .note-toolbar.card-header {
            display: none;
        }

        .note-resizebar {
            display: none;
        }

        .note-editor.note-frame.card {
            border: none;
            box-shadow: none;

        }

        .note-editable.card-block {

            outline: none;
        }

        .note-editor.note-frame .note-statusbar {
            border-top: 0px;
        }

        .popover-content.note-children-container {
            display: none;
        }

        textarea.note-codable {
            display: none;
        }

        textarea#summernote {
            display: none;
        }

    </style>
@endsection


@section('content')
    <div class="banner-product">
        <div class="container-fluid">
            <div class="heading-product">
                <div class="title-product">Sản Phẩm</div>
                <a>Trang chủ</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Sản phẩm</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Chi tiết sản phẩm</a>
            </div>

        </div>

    </div>
    <!-- end banner product -->
    <div class="detail-product">
        <div class="container">
            <div class="row">
                <div class=" col-lg-6 col-md-6">
                    <div class="image-detail-product">
                        <div class="image-product">
                            <img src="{{ asset('uploads/img/' . $detail_product->image) }}" id="imageProduct"
                                width="100%">
                        </div>
                        <div class="image-product-item">
                            @foreach ($images as $img)
                                <div class="image-item">
                                    <img src="{{ asset('uploads/img/' . $img) }}" class="imageItem" width="100%">
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 ">
                    <div class="content-detail-product ">
                        <div class="heading-detail">
                            <p class="text-center">{{ $detail_product->name }}</p>
                            <hr class="line-heading-detail">
                        </div>
                        <div class="content-detail">
                            <div class="price-detail">
                                <div class="title-detail">
                                    <p>Giá bán: <span>{{ number_format($detail_product->price) }} đ</span></p>
                                </div>
                            </div>
                            <div class="rate-detail">
                                <div class="title-detail">Đánh giá:
                                    <span>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="text-detail pt-3">
                                <div class="title-detail">
                                    <p>Mô tả sản phẩm:</p>
                                    <div class="detail">
                                        <textarea id="summernote"
                                            name="description">{{ $detail_product->description }}</textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="buy-now">
                                <a href="javascript:" onclick="AddCart('{{ $detail_product->id }}')"
                                    class="btn btn-lg btn-buy" role="button">Mua ngay</a>
                            </div>
                            <div class="share-product pt-3">
                                <div class="title-detail">
                                    <p>Chia sẻ sản phẩm:</p>
                                    <div class="icon-detail">
                                        <a href="#" title="Facebook"><i class="fa fa-facebook-square"
                                                aria-hidden="true"></i></a>
                                        <a href="#" title="Instagram"> <i class="fa fa-instagram"
                                                aria-hidden="true"></i></a>
                                        <a href="#" title="Twitter"> <i class="fa fa-twitter-square"
                                                aria-hidden="true"></i></a>
                                        <a href="#" title="Youtube"><i class="fa fa-youtube-play"
                                                aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end detail-product -->
    <div class="comment-product">
        <div class="container">

            <div class="detail-comment">
                <div class="title-comment">Đánh giá & bình luận sản phẩm</div>
                @if (Auth::check())
                    <div class="border-comment">
                        <form>
                            <div class="rate-comment">
                                Đánh giá sao
                                <div class="rate-star">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </form>
                        <form method="GET">
                            {{-- @csrf --}}
                            <div class="form-group comment">
                                <div class="form-group">
                                    <label for="comment-name">Nội dung bình luận</label>
                                    <input type="hidden" value={{ $detail_product->id }} name="detail_product_id">
                                    <textarea id="comment-content" name="content" rows="3"></textarea>
                                    <small id="notice-comment"></small>
                                </div>
                                <button type="submit" class="btn login-comment btn-comment" id="btn-comment">Gửi</button>
                            </div>
                        </form>
                    </div>
                @else
                    <a class="btn login-comment m-3" href="#" data-toggle="modal" data-target="#exampleModal">Vui lòng đăng
                        nhập</a>
                @endif
            </div>

            <div class="member-comment">
                <div class="title-comment">Đánh giá gần đây</div>

                @foreach ($comment_user as $key => $value)
                    <div class="content-comment">
                        <div class="image-member ">
                            <img src="{{ asset('asset/img/Image/user.png') }}" width="70px" height="70px">
                        </div>
                        <div class="content-detail-comment">
                            <div class="rate-star">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <span>{{ $value->user->name }} <small
                                    class="text-muted">{{ $value->created_at }}</small></span>

                            <p class="name-member mb-1">{{ $value->content }}</p>
                            <a href="#" onclick="DeleteComment('{{ $value->id }}')">Xóa</a>
                        </div>
                    </div>
                @endforeach
                <div id="content-comment" class="content-comment"></div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <ul class="nav nav-tabs header-form" id="myTab" role="tablist">
                                <li class="nav-item title-form " role="presentation">
                                    <a class="nav-link active" id="log-in" data-toggle="tab" href="#login" role="tab"
                                        aria-controls="home" aria-selected="true">ĐĂNG NHẬP</a>
                                </li>
                                <li class="nav-item title-form " role="presentation">
                                    <a class="nav-link " id="register-tab" data-toggle="tab" href="#register"
                                        role="tab" aria-controls="profile" aria-selected="false">ĐĂNG KÝ</a>
                                </li>
                            </ul>
                            <div class="modal-body body-form">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="login" role="tabpanel"
                                        aria-labelledby="log-in">
                                        <form class="form-login" action="" method="POST">
                                            {{-- @csrf --}}
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            {{-- thông báo thêm dữ liệu thành công --}}
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <input type="email" id="email" placeholder="Email" name="email">
                                            </div>
                                            <div class="form-group ">
                                                <input type="password" id="password" placeholder="Mật khẩu" name="password">
                                            </div>
                                            <a href="#">Quên mật khẩu?</a>
                                            <button type="submit" class="btn btn-login" id="btn-login">ĐĂNG NHẬP</button>
                                            <div class="social-user">
                                                <p class="heading-social text-center">Hoặc đăng nhập với</p>
                                                <div class="social-list">
                                                    {{-- <a href="#">
                                                    <img
                                                        src="{{ asset('asset/img/Image/facebook.svg') }}">
                                                </a> --}}
                                                    <a href="{{ url('Bakery/redirect') }}">
                                                        <img src="{{ asset('asset/img/Image/google.svg') }}">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="register-account">Do you have an account?
                                                <a data-toggle="tab" href="#register" data-toggle="tab">Đăng
                                                    ký</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="register" role="tabpanel"
                                        aria-labelledby="register-tab">
                                        <form action="{{ route('postregister') }}" method="POST" class="form-register">
                                            @csrf
                                            {{-- thông báo thêm dữ liệu không thành công --}}
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            {{-- thông báo thêm dữ liệu thành công --}}
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <input type="text" id="name" placeholder="Họ tên" name="name">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" id="email" placeholder="Email" name="email">
                                            </div>
                                            <div class="form-group ">
                                                <input type="password" id="password" placeholder="Mật khẩu" name="password">
                                            </div>
                                            <div class="form-group ">
                                                <input type="password" id="re-password" placeholder="Nhập lại mật khẩu"
                                                    name="re-password">
                                            </div>
                                            <button type="submit" class="btn btn-signup">Đăng ký</button>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- end comment product -->
    <div class="related-products">
        <div class="container">
            <div class="heading-related-products">
                <p>Sản Phẩm Liên Quan</p>
                <hr class="line-heading-related-products">
            </div>
            <div class="owl-carousel owl-theme">
                @foreach ($product_related as $key => $value)
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
                                        <a href="javascript:" onclick="AddCart('{{ $value->id }}')"
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
    <!-- end related products -->
@endsection

@section('js')
    <script src="{{ asset('asset/js/bakery/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/js/bakery/details-product.js') }}"> </script>

    <script src="{{ asset('asset/AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('#summernote').summernote({
            callbacks: {
                onPaste: function(e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData(
                        'Text');

                    e.preventDefault();

                    // Firefox fix
                    setTimeout(function() {
                        document.execCommand('insertText', false, bufferText);
                    }, 10);
                }
            }
        });

        var _csrf = '{{ csrf_token() }}';
        $('#btn-comment').click(function(ev) {
            ev.preventDefault();
            let content = $('#comment-content').val();
            let _commentUrl = "{{ route('comment_ajax', $detail_product->id) }}";

            $.ajax({
                url: _commentUrl,
                type: "GET",
                data: {
                    content: content,
                    _token: _csrf
                },
                success: function(res) {
                    if (res) {
                        $('#content-comment').html(res);
                        setTimeout(() => {

                            location.reload();
                        }, 1000);
                    }


                }
            });
        })

        function DeleteComment(id) {
            $.ajax({
                url: `{{ asset('Bakery/San-Pham/delete-comment/${id}') }}`,
                type: "GET",
               
            }).done(function() {

            });
            alertify.success('Xóa bình luận thành công!');
             setTimeout(() => {

                        location.reload();
                    }, 1000);
        }

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
