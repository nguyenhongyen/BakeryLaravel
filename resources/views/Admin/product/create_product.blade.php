@extends('admin.index')


@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="{{ url('/Admin') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('Product.index') }}">Quản lý sản phẩm</a></li>
            <li class="breadcrumb-item active">Thêm mới</li>
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
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm sản phẩm</h3>
                </div>
                <form method="POST" action="{{ route('Product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        onkeyup="ChangeToSlug();" id="slug" required>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" value="{{ old('slug') }}"
                                        id="convert_slug" required>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Danh mục</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($category as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea id="summernote" class="form-control" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-body">
                               
                                <div class="form-group">
                                    <label for="price">Giá bán</label>
                                    <input type="text" class="form-control" name="price">
                                </div>
                                 <div class="form-group">
                                    <label for="price">Phần trăm giảm giá</label>
                                    <input type="text" class="form-control" name="percent_sale">
                                </div>
                                <div class="form-group">
                                    <label for="sale_price">Giảm giá</label>
                                    <input type="text" class="form-control" name="sale_price">
                                </div>

                                <div class="form-group">
                                    <label for="image">Hình ảnh</label>
                                    <input type="file" class="form-control" name="image" id="image"
                                        onchange="loadFile(event)">
                                </div>
                                <div id="display_image"></div>
                                <div class="form-group">
                                    <label for="images">Hình ảnh liên quan</label>
                                    <input type="file" class="form-control" name="images[]" id="images"
                                        multiple='multipart' onchange="loadListFile(this.files)">
                                </div>
                                <div id="display_images">
                                    
                                </div>

                                <div class="form-group">
                                    <label for="status">Kích hoạt</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1">Kích hoạt</option>
                                        <option value="0">Không kích hoạt</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script src="{{ asset('asset/AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            $('#summernote').summernote({
                height: 300,
                placeholder: "Product description"
            });



        })
    </script>
@endsection



<script type="text/javascript">
    function loadFile(event) {

        var image = URL.createObjectURL(event.target.files[0]);
        var display_image = document.getElementById('display_image');
        var newimg = document.createElement('img');

        display_image.innerHTML = '';
        newimg.src = image;
        newimg.width = "100";
        display_image.appendChild(newimg);

    }

   
    function loadListFile(files) {
          var image = document.getElementById('display_images');
          while(image.firstChild){
              image.removeChild(image.firstChild);
          }
       
       for(var i= 0; i< files.length;i++){
           var reader = new FileReader();
           reader.onload = function(e){
               var element = document.createElement("img");
                    element.setAttribute("src",e.target.result);
                    element.style.width="30%";
                    element.style.margin="3px";
                    document.getElementById("display_images").appendChild(element);
           };
           reader.readAsDataURL(files[i]);
       }
    }

    function ChangeToSlug() {
        var slug;

        //Lấy text từ thẻ input title
        slug = document.getElementById("slug").value;
        slug = slug.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('convert_slug').value = slug;
    }
</script>


@endsection
