<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexAdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CouponController;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bakery\IndexBakeryController;
use App\Http\Controllers\Bakery\SearchController;
use App\Http\Controllers\Bakery\SocialController;
use Laravel\Socialite\Facades\Socialite;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('Admin.index');
// });


//------------------- Admin--------------------------------

Route::prefix('/Admin')->group(function(){
   
     Route::resource('/', IndexAdminController::class);
     Route::get('/Admin',[IndexAdminController::class,'index']);

    Route::resource('/Category', CategoryController::class);
    Route::get('/Category',[CategoryController::class,'index'])->name('Category.index');
    Route::get('/Category/Create',[CategoryController::class,'Create'])->name('Category.Create.create');

    Route::resource('/Product', ProductController::class);
    Route::get('/Product',[ProductController::class,'index'])->name('Product.index');
    Route::get('/Product/Create',[ProductController::class,'Create'])->name('Product.Create.create');

    Route::resource('/Slider', SliderController::class);
    Route::get('/Slider',[SliderController::class,'index'])->name('Slider.index');
    Route::get('/Slider/Create',[SliderController::class,'Create'])->name('Slider.Create.create');

    Route::resource('/Blog', BlogController::class);
    Route::get('/Blog',[BlogController::class,'index'])->name('Blog.index');
    Route::get('/Blog/Create',[BlogController::class,'Create'])->name('Blog.Create.create');

    Route::resource('/Coupon', CouponController::class);
    Route::get('/Coupon',[CouponController::class,'index'])->name('Coupon.index');
    Route::get('/Coupon/Create',[CouponController::class,'Create'])->name('Coupon.Create.create');

    Route::get('/Comment',[IndexAdminController::class,'comment'])->name('Comment.index');
    Route::get('/Comment/{id}',[IndexAdminController::class,'delete_comment'])->name('delete_comment');

    Route::get('/Favorite',[IndexAdminController::class,'favorite_cus'])->name('Favorite.favorite_cus');

    Route::get('/Customer',[IndexAdminController::class,'customer'])->name('Customer.customer');

    Route::get('/Order',[IndexAdminController::class,'order'])->name('Order.order');
    Route::get('/Order/{id}',[IndexAdminController::class,'order_show'])->name('Order.show');

    Route::get('/Xac-nhan-don-hang',[IndexAdminController::class,'confirm_order'])->name('confirm_order');

    
});
    
//-----------------------Bakery---------------------------------

    //trang chủ
  

    
    Route::prefix('/Bakery')->group(function(){
        Route::resource('/', IndexBakeryController::class);

        Route::get('/',[IndexBakeryController::class,'index'])->name('index');

        Route::get('/San-Pham',[IndexBakeryController::class,'product'])->name('product');
        Route::get('/Tin-Tuc',[IndexBakeryController::class,'blog'])->name('blog');
        Route::get('/Lien-He',[IndexBakeryController::class,'contact'])->name('contact');

        //xem chi tiết sản phẩm
        Route::get('/San-pham/{id}/{slug}',[IndexBakeryController::class,'detail_product']);
        //xem chi tiết blog
        Route::get('/Blog/{id}/{slug}',[IndexBakeryController::class,'detail_blog']);


        //tìm kiếm sản phẩm ajax
         Route::get('/San-pham/search',[IndexBakeryController::class,'search_ajax'])->name('search_ajax');
         //tìm kiếm theo danh mục loại bánh
         Route::get('/San-Pham/{id}',[IndexBakeryController::class,'category_ajax'])->name('category_ajax');
        //tìm kiếm theo select
         Route::get('/Sap-xep/{id}',[IndexBakeryController::class,'select_ajax'])->name('select_ajax');
        //tìm kiếm theo khoảng tiền
        Route::get('/Gia-tien/{id}',[IndexBakeryController::class,'price_ajax'])->name('price_ajax');

        //tìm kiếm sản phẩm form
        Route::get('/San-pham/tim-kiem',[IndexBakeryController::class,'search_product'])->name('search_product');

        //tìm kiếm blog
        Route::get('/Blog/tim-kiem',[IndexBakeryController::class,'search_blog'])->name('search_blog');

        //giỏ hàng
        Route::get('/Gio-hang',[IndexBakeryController::class,'Cart'])->name('Cart');

        Route::get('/Gio-hang/{id}',[IndexBakeryController::class,'add_cart'])->name('add_cart');

        Route::get('/Delete-cart/{id}',[IndexBakeryController::class,'delete_cart'])->name('delete_cart');

        Route::get('/Save-cart/{id}/{qty}',[IndexBakeryController::class,'save_cart'])->name('save_cart');


         
        //thanh toán giỏ hàng
        Route::get('/Thanh-toan',[IndexBakeryController::class,'pay_bill'])->name('pay_bill');

        //thanh toán đơn hàng
        Route::post('/Dat-hang',[IndexBakeryController::class,'bill'])->name('bill');

        // đăng nhập với google
        Route::get('/redirect', [SocialController::class,'redirect']);
        Route::get('/callback', [SocialController::class,'callback']);

        // log out
        Route::get('/log-out', [SocialController::class,'logOut'])->name('logOut');

        //đăng ký thành viên
         Route::post('/Dang-ky-thanh-vien',[IndexBakeryController::class,'post_register'])->name('postregister');

         //đăng nhập thành viên
         Route::post('/Dang-nhap-thanh-vien',[IndexBakeryController::class,'post_login'])->name('post-login');
      
      
        //xem hồ sơ cá nhân
        Route::get('/Ho-so-thanh-vien', [IndexBakeryController::class,'information_user'])->name('information_user');
        Route::get('/Thong-tin-don-hang', [IndexBakeryController::class,'order'])->name('order');
        Route::get('/San-pham-yeu-thich', [IndexBakeryController::class,'user_favorite'])->name('user_favorite');


        //comment-product-ajax
        Route::get('/comment/{product_id}',[IndexBakeryController::class,'comment_ajax'])->name('comment_ajax');
        Route::get('/San-Pham/delete-comment/{id}',[IndexBakeryController::class,'delete_comment_ajax'])->name('delete_comment_ajax');

        //comment-blog-ajax
        Route::get('/comment_blog/{blog_id}',[IndexBakeryController::class,'comment_blog'])->name('comment_blog');

        //liên hệ
        Route::post('/Lien-he',[IndexBakeryController::class,'post_contact'])->name('post_contact');

        //yêu thích sản phẩm
         Route::get('/Yeu-thich/{id}',[IndexBakeryController::class,'favorite'])->name('favorite');
    });
  
  
    