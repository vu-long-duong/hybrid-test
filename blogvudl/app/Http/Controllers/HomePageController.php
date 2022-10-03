<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Paginator;

class HomePageController extends Controller
{    
    /**
     * Hiển thị chi tiết bài viết
     *
     * @param  mixed $request
     * @param  mixed $slug
     * @return Illuminate/Contracts/View/View
     */
    public function postdetail(Request $request,$slug){
        $posts=Post::where('slug_post',$slug)->first();
        $slidebar = Post::where('category_id', $posts->category_id)->limit(4)->get();
        $tags=Tag::where('hot',1)->orderBy('id','DESC')->paginate(5);
        return view('pages.postdetail')->with(compact('posts','slidebar','tags'));
    }
    
    /**
     * Hiển thị các bài viết theo danh mục
     *
     * @param  mixed $slug
     * @return Illuminate/Contracts/View/View
     */
    public function categoryDetail($slug){

        $slidebar = Post::orderBy('id', 'DESC')->limit(4)->get();
        $categories=Category::where('slug_category',$slug)->where('status',1)->first();
        $tags=Tag::where('hot',1)->orderBy('id','DESC')->paginate(5);
        if($categories){
            $posts=Post::where('category_id',$categories->id)->where('status',1)->paginate(5);
            
            return view('pages.categorydetail')->with(compact('posts','slidebar','categories','tags'));
        }
    }

    /**
     * Trang chủ
     *
     * @return Illuminate/Contracts/View/View
     */
    public function homepage(){
        $slidebar = Post::orderBy('id', 'DESC')->limit(4)->get();
        $categories=Category::orderBy('id','DESC')->where('status',1)->get();
        $posts=Post::orderBy('id','DESC')->paginate(4);
        $postnew=Post::orderBy('id','DESC')->first();
        $tags=Tag::where('hot',1)->orderBy('id','DESC')->paginate(5);
        
        return view('pages.homepage')->with(compact('categories','posts','slidebar','postnew','tags'));
    }
    
    /**
     * tìm kiếm theo tag đã chọn
     *
     * @param  mixed $request
     * @param  mixed $slug
     * @return Illuminate/Contracts/View/View
     */
    public function tag(Request $request, $slug){
        $slidebar = Post::orderBy('id', 'DESC')->limit(4)->get();
        $tags=Tag::with('posts')->where('content', 'LIKE', '%' .$slug . '%')->get();

        return view('pages.tagsearch')->with(compact('tags','slidebar','slug'));
    }
        
    /**
     * Tìm kiếm bài viết trên trang chủ
     *
     * @return Illuminate/Contracts/View/View
     */    
    public function searchPost(){
        $data=Post::search()->get();

        return view('ajaxSearch',compact('data'));
    }
}
