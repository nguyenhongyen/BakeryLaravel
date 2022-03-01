<?php

namespace App\Http\Controllers\Bakery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Blog;
use App\Models\Admin\Category;
use App\Models\Admin\Slider;
use App\Models\Bakery\Comment;
use App\Models\Bakery\CommentBlog;
use App\Models\Bakery\Contact;
use App\Models\Bakery\Favorite;
use App\Models\Bakery\Bill;
use App\Models\Bakery\DetailBill;
use App\Models\User;
use Cart;
use Illuminate\Support\Facades\DB;
//  use Dotenv\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class IndexBakeryController extends Controller
{
    public function index()
    {
        $product_today = Product::orderBy('id', 'DESC')->paginate(8);
        $product_new = Product::orderBy('id', 'ASC')->get();

        $blog = Blog::orderBy('id', 'DESC')->paginate(4);
        $user = User::all();

        $slider = Slider::all();
       
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        return view('Bakery.bakery', compact('product_today', 'product_new', 'blog', 'slider', 'user', 'count_favorite'));
    }

    public function product(Request $request)
    {
        $product = Product::orderBy('id', 'ASC')->paginate(9);

        $category = Category::where('category_type', 1)->get();

        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        return view('Bakery.product', compact('product', 'category', 'count_favorite'));
    }

    public function detail_product($id, Request $req)
    {
        $detail_product = Product::where('id', $req->id, $req->slug)->first();

        $product = Product::find($id);
        $image_list = Product::select('image_list')->where('id', $id)->get();
          
        $image=$image_list->pluck('image_list')->toArray();
        $image2=implode('|', $image);
        $images=explode('|', $image2);
        

        $product_related = Product::orderBy('id', 'ASC')->get();

        $comment_user = Comment::where('product_id', $req->id)->get();

        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        return view('Bakery.details-product', compact('detail_product', 'product', 'image_list', 'image', 'image2', 'images', 'product_related', 'comment_user', 'count_favorite'));
    }

    public function blog()
    {
        $blog = Blog::orderBy('id', 'DESC')->get();

        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }
        return view('Bakery.blog', compact('blog', 'count_favorite'));
    }

    public function detail_blog($id, Request $req)
    {
        $blog = Blog::all()->take(4);

        $detail_blog = Blog::where('id', $req->id, $req->slug)->first();
        $tag = explode(',', $detail_blog->tag_blog);

        $comment_user = CommentBlog::where('blog_id', $req->id)->get();

        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        return view('Bakery.details-blog', compact('detail_blog', 'blog', 'tag', 'comment_user', 'count_favorite'));
    }

    public function contact()
    {
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }
        return view('Bakery.contact', compact('count_favorite'));
    }

    public function search_ajax()
    {
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }
        $data = Product::search()->get();
       
        return view('Bakery.search-ajax', compact('data','count_favorite'));
    }

    public function category_ajax($id, Request $req)
    {
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        $product = Product::where('category_id', $id)->get();

        return view('Bakery.search-category-ajax', compact('product','count_favorite'));
    }

    public function select_ajax($id, Request $request)
    {
        switch ($request->id) {
            case 2:
                $product = Product::orderBy('price', 'ASC')->get();
              break;
            case 3:
                 $product = Product::orderBy('price', 'DESC')->get();
               
              break;
           
            default:
              $product = Product::orderBy('id', 'DESC')->get();
          }

          $count_favorite = 0;
          if (Auth::check()) {
              $user_id = Auth::user()->id;
              $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
          }
        return view('Bakery.search-category-ajax', compact('product','count_favorite'));
    }

    public function price_ajax($id, Request $request)
    {
        switch ($request->id) {
            case 1:
                $product = Product::where('price', '<', '50000')->get();
              break;
            case 2:
                $product = Product::whereBetween('price', [50000,100000])->get();
            break;
           
            default:
              $product = Product::where('price', '>', '100000')->get();
          }

          $count_favorite = 0;
          if (Auth::check()) {
              $user_id = Auth::user()->id;
              $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
          }
        return view('Bakery.search-category-ajax', compact('product','count_favorite'));
    }

    public function search_product()
    {
        $key = $_GET['search'];
        $category = Category::where('category_type', 1)->get();

        $product = Product::where('name', 'LIKE', '%' . $key .  '%')->orWhere('price', 'LIKE', '%' . $key . '%')->orWhere('sale_price', 'LIKE', '%' . $key . '%')->get();

        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        return view('Bakery.search', compact('product', 'key', 'category', 'count_favorite'));
    }
    public function Cart()
    {
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }
        return view('Bakery.cart', compact('count_favorite'));
    }

    public function add_cart($id)
    {
        $product = Product::where('id', $id)->first();

        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        if (isset($product)) {
            Cart::add([
                'id' => $product->id,
                'name' =>  $product->name,
                'qty' => 1,
                'price' =>  $product->price,
                'weight' => 0,
                'options' => array('image' => $product->image)
            ]);
        }
       

        return view('Bakery.cart', compact('count_favorite'));
    }

    public function delete_cart($id)
    {
        Cart::remove($id);
        
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        return view('Bakery.cart', compact('count_favorite'));
    }

    public function save_cart($id, $quantity)
    {
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        Cart::update($id, $quantity);

        return view('Bakery.cart', compact('count_favorite'));
    }

    public function pay_bill()
    {
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        return view('Bakery.checkout', compact('count_favorite'));
    }

    public function bill(Request $request)
    {
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        $bill = new Bill();
        $bill->user_id = Auth::user()->id;
        $bill->total = Cart::subtotal(0);
        $bill->pay = $request->pay;
        $bill->note = $request->note;
        $bill->address = $request->address;
        $bill->phone = $request->phone;
        $bill->status = 'new';
        $bill->save();

        foreach (Cart::content() as $key => $value) {
            $detailBill = new DetailBill();
            $detailBill->id_bill = $bill->id;
            $detailBill->id_product = $value->id;
            $detailBill->quantity = $value->qty;
            $detailBill->price = $value->price;
            $detailBill->save();
        }
        $request->session()->forget('cart');
        return view('Bakery.success', compact('count_favorite'));
    }
    public function post_register(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:5|max:15',
            're_password'=>'same:password'

        ], [
           
            'name.required'=>'Vui lòng nhập họ tên để đăng ký tài khoản',
            'email.required'=>'Vui lòng nhập email để đăng ký tài khoản',
            'email.unique'=>'Email đã được đăng ký tài khoản',
            'password.required'=>'Vui lòng nhập mật khẩu để đăng ký tài khoản',
            'password.min'=>'Mật khẩu phải ít nhất 5 ký tự và nhỏ hơn 15 ký tự',
            're_password.same'=>"Xác thực mật khẩu không trùng khớp",
            Alert::warning('Thông báo', 'Vui lòng nhập đầy đủ thông tin!')
        ]);

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->google_id = null;

        $user->save();

        Alert::success('Thông báo', 'Đăng ký tài khoản thành công!');
        return redirect()->back();
    }
    public function post_login(Request $request)
    {
        $data = $request->validate([
            
            'email'=>'required|email',
            'password'=>'required|min:5|max:15',
           

        ], [
           
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Email không đúng định dạng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu phải ít nhất 5 ký tự và nhỏ hơn 15 ký tự',
           
        ]);

        $check = $request->only(['email','password']);

        if (Auth::attempt($check)) {
                Alert::success('Thông báo', 'Đăng nhập thành công!');
            return redirect()->back()->with(['status' => 'Đăng nhập thành công']);
        } else {
            
            Alert::error('Thông báo', 'Tên đăng nhập hoặc mật khẩu không chính xác!!!');

            return redirect()->back();
        }
    }

    public function comment_ajax($product_id, Request $request)
    {
        $user_id =  Auth::user()->id;
      
        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->product_id = $product_id;
        $comment ->content = $request->content;
        $comment ->rep_id = 0;
        $comment ->status = 1;
          
        $comment->save();

        $comment_user = Comment::where('product_id', $product_id)->get();
        $comment = Comment::orderBy('id', 'DESC')->where('product_id', $product_id)->first();

        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }
        return view('Bakery.list_comment', compact('comment_user', 'comment','count_favorite'));
    }

    public function delete_comment_ajax($id)
    {
        $comment= Comment::find($id)->delete();

        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        return view('Bakery.details-product', compact('comment','count_favorite'));
    }

    public function comment_blog($blog_id, Request $request)
    {
        $user_id =  Auth::user()->id;
      
        $comment = new CommentBlog();
        $comment->user_id = $user_id;
        $comment->blog_id = $blog_id;
        $comment ->content = $request->content;
        $comment ->rep_id = 0;
        $comment ->status = 1;
      
        $comment->save();

        $comment_user = CommentBlog::where('blog_id', $blog_id)->get();
        $comment = CommentBlog::orderBy('id', 'DESC')->where('blog_id', $blog_id)->first();

        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        return view('Bakery.comment_blog', compact('comment_user', 'comment','count_favorite'));
    }

    public function post_contact(Request $req)
    {
        $data = $req->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'content'=>'required'
            
        ], [
            'name.required'=> 'Vui lòng nhập tên',
            'email.required'=> 'Email không để trống',
            'phone.required'=> 'Vui lòng nhập số điện thoại',
            'content.required'=> 'Vui lòng nhập nội dung liên hệ',
           
     
        ]);

        $contact = new Contact();
        $contact->name = $data['name'];
        $contact->email = $data['email'];
        $contact->phone = $data['phone'];
        $contact->content= $data['content'];

        $contact->save();
        return redirect()->route('contact')->with('status', 'Gửi thành công!');
    }

    public function search_blog()
    {
        $key = $_GET['search'];
        $blog = Blog::where('name_blog', 'LIKE', '%'.$key.'%')->orWhere('synopsis_blog', 'LIKE', '%'.$key.'%')->paginate(3);

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        return view('Bakery.blog', compact('blog', 'key', 'count_favorite','count_favorite'));
    }

    public function favorite($id, Request $request)
    {
        $product = Product::find($id);
    
        $list_drink = Favorite::where('product_id', $id)->get();

        // dd($list_drink);

        try {
            if (Auth::check()) {
                if (isset($list_drink) && count($list_drink) > 0) {
                    return response(['fail' => 'Sản phẩm đã được yêu thích']);
                }
                DB::table('favorites')->insert([
                    'product_id' => $product->id,
                    'user_id' => Auth::user()->id
                ]);

                return response(['success' => 'Đã thêm yêu thích thành công']);
            } else {
                return response(['fail' => 'Bạn phải đăng nhập!']);
            }
        } catch (Exception $e) {
            $mess = "Không thêm thành công";
        }
    }

    public function information_user()
    {
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }
        return view('Bakery.information-user', compact('count_favorite'));
    }

    public function order()
    {
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }
        $show = Bill::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
           
        return view('Bakery.show-user', compact('count_favorite', 'show'));
    }

    public function user_favorite()
    {
        $count_favorite = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_favorite = Favorite::where('user_id', $user_id)->get()->count();
        }

        $product = Favorite::where('user_id', Auth::user()->id)->get();
           
        return view('Bakery.favorite-user', compact('count_favorite', 'product'));
    }
}
