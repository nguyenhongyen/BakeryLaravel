@extends('admin.index')


@section('breadcrumb')
<div class="col-sm-6">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item"><a href="{{ url('/Admin') }}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Category.index') }}">Quản lý Slider</a></li>
        <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
   
</div>
@endsection

@section('content')

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
                  <h3 class="card-title">Thêm Slider</h3>
                </div>
                <form method="POST" action="{{ route('Slider.store') }}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="slider_name">Tên Slider</label>
                      <input type="text" class="form-control" name="slider_name"  value="{{old('slider_name')}}">
                    </div>
                    <div class="form-group">
                        <label for="slider_link">Mô tả</label>
                        <input type="text" class="form-control" name="slider_link"  value="{{old('slider_link')}}">
                      </div>
                    <div class="form-group">
                      <label for="slider_image">Hình ảnh</label>
                      <input type="file" class="form-control" name="slider_image"  value="{{old('slider_image')}}">
                    </div>
                    <div class="form-group">
                        <label for="slider_status">Kích hoạt</label>
                        <select class="form-control" id="slider_status" name="slider_status">
                          <option value="1">Kích hoạt</option>
                          <option value="0">Không kích hoạt</option>
                        </select>
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
 

@endsection