<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->search()->paginate(7);
       
        return view('Admin.category.index_category',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.category.create_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_name'=>'required|unique:category|max:255',
            'category_slug'=>'required',
            'category_status'=>'required',
            'category_type'=>'required'
            
        ],[
            'category_name.unique'=> 'Tên danh mục đã có',
            'category_name.required'=> 'Tên danh mục không được để trống',
            'category_slug.required'=> 'Slug không được để trống'
           
     
        ]);

        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->category_slug = $data['category_slug'];
        $category->category_status = $data['category_status'];
        $category->category_type = $data['category_type'];

        $category->save();
        return redirect()->route('Category.index')->with('status', 'Thêm danh mục thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('Admin.category.edit_category',compact('category'));
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
        $data = $request->validate([
            'category_name'=>'required|max:255',
            'category_slug'=>'required',
            'category_status'=>'required',
            'category_type'=>'required'
            
        ],[
            // 'category_name.unique'=> 'Tên danh mục đã có',
            'category_name.required'=> 'Tên danh mục không được để trống',
            'category_slug.required'=> 'Slug không được để trống'
           
     
        ]);

        $category = Category::find($id);
        $category->category_name = $data['category_name'];
        $category->category_slug = $data['category_slug'];
        $category->category_status = $data['category_status'];
        $category->category_type = $data['category_type'];


        $category->save();
        return redirect()->back()->with('status', 'Chỉnh sửa danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('status','Xóa danh mục thành công');
    }
}
