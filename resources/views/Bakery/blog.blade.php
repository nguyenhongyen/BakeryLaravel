@extends('bakery.index')
@section('css')
    <link rel="stylesheet" href="{{ asset('asset/css/bakery/blog.css') }}">
@endsection

@section('content')
    <div class="banner-product">
        <div class="container-fluid">
            <div class="heading-product">
                <div class="title-product">Tin tức</div>
                <a>Trang chủ</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a>Tin tức</a>
            </div>

        </div>

    </div>
    <!-- end banner product -->
    <div class="blog">
        <div class="container">
            <div class="row">
                @foreach ($blog as $key => $value)
                    <div class="col-12 col-lg-4 col-md-6 mb-3 p-3 article-hover animate__animated animate__zoomIn ">
                        <a href="{{ url('Bakery/Blog/'.$value->id .'/' . $value->slug_blog) }}" class="article">
                            <img src="{{ asset('uploads/img/' . $value->img_blog) }}" width="100%" class="rounded">
                            <div class="content-article">
                                <div class="heading-article">{{ $value->name_blog }}</div>
                                <div class="date-article">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $value->created_at }}
                                    <i class="fa fa-eye" aria-hidden="true"></i> 2.200
                                </div>
                                <div class="text-article">{{ $value->synopsis_blog }}</div>
                            </div>
                        </a>

                    </div>
                @endforeach
            </div>
            <!-- pagination -->
            {{-- <div class="paginate" >
                
                    {{ $blog->links() }}
             

            </div> --}}
            <!-- end pagination -->
        </div>
    </div>

    <!-- end blog -->

@endsection

@section('js')
    <script src="{{ asset('asset/js/bakery/owl.carousel.min.js') }}"></script>

@endsection
