@extends('bakery.index')
@section('css')
    <link rel="stylesheet" href="{{ asset('asset/css/bakery/contact.css') }}">
@endsection

@section('content')
    <div class="banner-product">
        <div class="container-fluid">
            <div class="heading-product">
                <div class="title-product">Liên hệ</div>
                <a>Trang chủ</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Liên hệ</a>
            </div>

        </div>

    </div>
    <!-- end banner product -->
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 contact-left">
                    <h4>Gửi tin nhắn cho chúng tôi</h4>
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
                    <form action="{{ route('post_contact') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Họ và tên </label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="contact-text">Nội dung</label>
                            <textarea id="contact-text" rows="3" name="content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit">Gửi</button>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6 contact-right">
                    <div class="contact-text">
                        <div class="item-contact">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <div class="item-text">
                                <p class="heading">Địa chỉ liên hệ</p>
                                <p>Số 12, đường Nguyễn Văn Cừ, quận Ninh Kiều, TP Cần Thơ</p>
                            </div>

                        </div>
                        <div class="item-contact">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <div class="item-text">
                                <p class="heading">Số điện thoại</p>
                                <p>0923 777 223</p>
                            </div>
                        </div>
                        <div class="item-contact">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <div class="item-text">
                                <p class="heading">Email</p>
                                <p>Bakery@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact -->
    <div class="map">
        <div class="container">
            <h4 class="p-4">Bản đồ</h4>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.56792815602!2d105.77239291461595!3d10.052467392815188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08807185668c5%3A0xf929188cd55218c9!2zU-G7kSAxMiBOZ3V54buFbiBWxINuIEPhu6ssIEFuIEhvw6AsIE5pbmggS2nhu4F1LCBD4bqnbiBUaMahLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1639839424783!5m2!1svi!2s"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
    <!-- end map -->
@endsection

@section('js')
    <script src="{{ asset('asset/js/bakery/owl.carousel.min.js') }}"></script>
@endsection
