@extends('admin.index')

@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="{{ url('/Admin') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý bài viết</li>
        </ol>

    </div>
    <div class="col-sm-6 ">
        <a class="btn btn-primary float-right" href="{{ route('Blog.create') }}" role="button">Thêm</a>
    </div>
@endsection
@section('content')
    <div class="container-fuiler">
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bài viết</h3>
                        <div class="card-tools">
                            <form action="">
                                <div class="input-group input-group-sm" style="width:350px;">
                                    <input type="text" name="search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append ">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên bài viết</th>
                                    <th>Hình ảnh</th>
                                    <th>Danh mục</th>
                                    <th>Tóm tắt nội dung</th>
                                    <th>Trạng thái</th>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blog as $key => $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name_blog }}</td>
                                    <td><img src="{{ asset('uploads/img/'.$value->img_blog) }}" width="100" height="100"></td>
                                    <td>{{$value->category->category_name  }}</td>
                                    {{-- <td>{{ $value->synopsis_blog }}</td> --}}
                                    <td>
                                        @if($value->status_blog==1)
                                            <span class="text text-success">Kích hoạt</span>
                                        @else
                                            <span class="text-danger">Không kích hoạt</span>
                                        @endif
                                    </td>
                                   
                                    <td class="d-flex ">
                                        <a href="{{route('Blog.show',[$value->id])}}" class="mr-3 "><i class="fa fa-eye" title="View"></i></a>
                                        <a href="{{ route('Blog.edit',[$value->id]) }}" class="mr-3 "><i class="fas fa-edit " title="Edit"></i></a>
                                       <form method="POST" action="{{ route('Blog.destroy',[$value->id]) }}">
                                           @method('DELETE')
                                           @csrf
                                            <button  onclick="return confirm('Bạn có muốn xóa bài viết này không?')" style="border:none;background:none;color: #1b8ffa;">
                                                <i class="fas fa-trash-alt" title="Delete"></i>
                                            </button>
                                        </form>
                                       
                                    </td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                     
                </div>

                    <nav aria-label="Page navigation" class="float-right">
                        {{ $blog->appends(request()->all())->links()  }}  
                   </nav>
            </div>
        </div>

    </div>
@endsection
