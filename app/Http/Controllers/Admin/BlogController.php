<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::orderBy('id','DESC')->search()->paginate(5);
        return view('Admin.blog.index_blog',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('category_type',0)->get();
        return view('Admin.blog.create_blog',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name_blog'=>'required|unique:blogs',
            'slug_blog'=>'required',
            'synopsis_blog'=>'required',
            'category_blog'=>'required',
            'description_blog'=>'required',
            'img_blog'=>'required',
            'tag_blog'=>'required',
            'status_blog'=>'required'
        ],[
            'name_blog.required' =>'Tên bài viết không được để trống',
            'slug_blog.required'=>'Slug không được để trống',
            'synopsis_blog.required'=>'Tóm tắt bài viết không được để trống',
            'category_blog.required'=>'Danh mục không được để trống',
            'description_blog.required'=>'Nội dung bài viết không được để trống',
            'img_blog.required'=>'Hình ảnh không được để trống',
            'tag_blog.required'=>'Tag không được để trống',
            'status_blog.required'=>'Trạng thái không được để trống'
        ]);

        $blog = new Blog();
        $blog->name_blog = $data['name_blog'];
        $blog->slug_blog = $data['slug_blog'];
        $blog->synopsis_blog = $data['synopsis_blog'];
        $blog->category_blog = $data['category_blog'];
        $blog->description_blog = $data['description_blog'];
        $blog->tag_blog = $data['tag_blog'];
        $blog->status_blog = $data['status_blog'];
      
        if ($files=$request->file('img_blog')) {
           
            $imageName=time().'_'.$files->getClientOriginalName();
            $files->move(\public_path("uploads/img/"), $imageName);
            $blog->img_blog = $imageName;


             $blog->save();
             return redirect()->route('Blog.index')->with('status', 'Thêm bài viết thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog= Blog::find($id);
        $category = Category::where('category_type','0')->get();

        return view('Admin.blog.view_blog',compact('blog','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog= Blog::find($id);
        $category = Category::where('category_type','0')->get();
        return view('Admin.blog.edit_blog',compact('blog','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->validate([
            'name_blog'=>'required',
            'slug_blog'=>'required',
            'synopsis_blog'=>'required',
            'category_blog'=>'required',
            'description_blog'=>'required',
            'tag_blog'=>'required',
            'status_blog'=>'required'
        ],[
            'name_blog.required' =>'Tên bài viết không được để trống',
            'slug_blog.required'=>'Slug không được để trống',
            'synopsis_blog.required'=>'Tóm tắt bài viết không được để trống',
            'category_blog.required'=>'Danh mục không được để trống',
            'description_blog.required'=>'Nội dung bài viết không được để trống',
            'tag_blog.required'=>'Tag không được để trống',
            'status_blog.required'=>'Trạng thái không được để trống'
        ]);

        $blog = Blog::find($id);
        $blog->name_blog = $data['name_blog'];
        $blog->slug_blog = $data['slug_blog'];
        $blog->synopsis_blog = $data['synopsis_blog'];
        $blog->category_blog = $data['category_blog'];
        $blog->description_blog = $data['description_blog'];
        $blog->tag_blog = $data['tag_blog'];
        $blog->status_blog = $data['status_blog'];
      
        if($request->hasFile('img_blog')){
              
            $destination ='uploads/img/'.$blog->img_blog;
      
            if(File::exists($destination)){
                File::delete($destination);
            }else{
                 $file = $request->file("image");
                  $imageName=time().'_'.$file->getClientOriginalName();
                  $file->move(\public_path("uploads/img/"),$imageName);
                  $blog->img_blog = $imageName;
            }
        }

        $blog->save(); 
        return redirect()->route('Blog.index')->with('status', 'Chỉnh sửa bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::find($id)->delete();
        return redirect()->back()->with('status','Xóa bài viết thành công!');
    }
}
