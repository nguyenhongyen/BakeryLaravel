@extends('admin.index')


@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="{{ url('/Admin') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('Product.index') }}">Quản lý sản phẩm</a></li>
            <li class="breadcrumb-item active">Sản phẩm</li>
        </ol>

    </div>
@endsection





@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('asset/AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
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
        .note-editor.note-frame .note-statusbar {
            border-top:0px;
        }

    </style>
@endsection

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                {{-- <div class="card-header">
                    <h3 class="card-title">Sản phẩm</h3>
                </div> --}}
                <div class="row">
                    <div class="col-md-5">
                        <div class="imgae mt-4">
                            <img src="{{ asset('uploads/img/' . $product->image) }}" class="mx-auto d-block"
                                width="70%">
                        </div>
                        <div class="image_list text-center p-2">
                            @foreach ($images as $img)
                                <img src="{{ asset('uploads/img/' . $img) }}" width="24%">
                            @endforeach
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="product m-4">
                            <p class="text-center" style="font-size:32px; font-weight:bold; color:rgb(207, 60, 34)">
                                {{ $product->name }}</p>
                            <div class="content" style="padding-top:20px; font-size:20px">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Tên sản phẩm</th>
                                            <td class="text-danger"> {{ $product->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Slug</th>
                                            <td> {{ $product->slug }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Danh mục </th>
                                            <td> {{ $product->category->category_name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Giá bán</th>
                                            <td> {{ $product->price }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Giảm giá</th>
                                            <td> {{ $product->sale_price }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phần trăm giảm giá</th>
                                            <td> {{ $product->percent_sale }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Mô tả sản phẩm</th>
                                        
                                            <td>
                                                <textarea id="summernote"
                                                    name="description">{{ $product->description }}</textarea>
                                            </td>

                                        </tr>
                                        <tr>
                                            <th scope="row">Trạng thái</th>
                                            <td>
                                                @if ($product->status == 1)
                                                    <span class="text text-success">Kích hoạt</span>
                                                @else
                                                    <span class="text-danger">Không kích hoạt</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@section('script')
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
    </script>
@endsection
@endsection
