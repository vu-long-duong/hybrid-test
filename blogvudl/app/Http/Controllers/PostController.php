<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use Illuminate\Support\Facades\Paginator;
use App\Http\Controllers\UpdateImagetTrait;
use Elasticsearch\ClientBuilder;
use Elasticquent\ElasticquentTrait;
use Elasticquent\ElasticquentPaginator;
use Intervention\Image\Facades\Image;
use Exception;
use Throwable;

use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    use UpdateImagetTrait;

    /**
     * Hiển thị các bài viết đã tạo
     *
     * @return Illuminate/Contracts/View/View
     */
    public function index()
    {
        
        $listPost = Post::orderBy('id', 'DESC')->paginate(env('PAGE_FIVE'));
        $postSort=Post::orderBy('created_at','ASC')->first();
        $postSort=date('d-m-Y');
        Post::addAllToIndex();
        // dd($postSort);
        //$tags =Tag::orderby('id','DESC')->get();
        $tags=Post::find(16)->tags()->get();  
        return view('admin.post.index')->with(compact('listPost','tags','postSort'));


    }

    /**
     * Hiển thị view để tạo tiêu đề cho bài viết
     *
     * @return Illuminate/Contracts/View/View
     */
    public function create()
    {
        $category = Category::with('posts')->get();
        $tags =Tag::orderby('id','DESC')->get();
        return view('admin.post.create')->with(compact('category','tags'));
    }

    /**
     * Tạo bài viết
     *
     * @param  mixed $request
     * @return Illuminate/Contracts/View/View
     */
    public function store(StorePost $request)
    {
          
        try {
            $post = new Post();
            $post->title = $request->title;
            $post->summary = $request->summary;
            $post->content = $request->content;
            $post->slug_post = $request->slug_post;
            $post->status = $request->status;
            
            $post->user_id = Auth()->user()->id;
            $post->category_id = $request->category;


            if ($request->hasFile('image')) {
                $image = $request->image;
                $image = $this->uploadimage($image, 'image', 'images');
                $post->imagepost = $image;
            }

            // if($request->hasFile('image')){
            //     $image = $request->image;
            //     $input['imagename'] = time().'.'.$image->extension();
            
            //     $filePath = storage_path('images');
            //     $img = Image::make($image->path());
            //     $img->resize(150, 300, function ($const) {
            //         $const->aspectRatio();
            //     })->save($filePath.'/'.$input['imagename']);
        
            //     $filePath = storage_path('/images');
            //     $image->move($filePath, $input['imagename']);
            // }

            $post->save();

            $tags=$request->tag ??[];
            
            if(!empty($tags) && is_array($tags)){
                foreach($tags as $value){  
                $post->tags()->attach($value);                    
            }
            }

            Log::channel('custom_log')->info('Tạo thành công bài viết: ' . $request->title);
            return redirect()->back()->with('success', 'tạo thành công bài viết');
            

        } catch (Throwable $throw) {
            Log::channel('custom_log')->error($throw->getMessage());
            return redirect()->back()->with('errors', 'Không tạo được bài viết');
        }
        
    }

    /**
     * Phần tìm kiếm các bài đăng
     *
     * @param  mixed $request
     * @return @return Illuminate/Http/Response
     */
    public function search1(Request $request)
    {
        $output = '';
        $posts = Post::where('title', 'LIKE', '%' . $request->keyword . '%')->get();

        foreach ($posts as $post) {

            $output = ' <tr>
            
            <td scope="row">' . $post->id . '</td>
            <td> <a href="#">' . $post->title . '</a></td>
            <td>' . $post->slug_post . '</td>
            <td>' . $post->status . '</td>           
            </tr>';
        }
        
        return response()->json($output);
    }



    /**
     * Hiển thị form sửa bài viết
     *
     * @param  mixed $id
     * @return Illuminate/Contracts/View/View
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $tags =Tag::orderby('id','DESC')->get();
        $this->edit=$post->tags()->get()->pluck('id')->toArray();
        // dd($this->edit);
        $category = Category::with('posts')->get();
        return view('admin.post.edit')->with(compact('post', 'category','tags'));
    }


    /**
     * Sửa bài viết
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return Illuminate/Contracts/View/View
     */
    public function update(UpdatePost $request, $id)
    {
        
        try {
            
            $post = Post::find($id);
            $this->edit=$post->tags()->get()->pluck('id');
            $post->title = $request->title;
            $post->summary = $request->summary;
            $post->content = $request->content;
            $post->slug_post = $request->slug_post;
            $post->status = $request->status;
            // $post->tag = 'tag';
            $id = Auth()->user()->id;
            $post->user_id = $id;

            $post->category_id = $request->category;

            
            if ($request->hasFile('image')) {
                $image = $request->image;
                
                $image = $this->uploadimage($image, 'image', 'images');
                $post->imagepost = $image;
                
            }

            $post->save();
            $tags=$request->tag ??[];
            dd($tags);
            
            if(!empty($tags) && is_array($tags)){
                foreach($tags as $value){  
                $post->tags()->attach($value);                    
            }
            }
            

            Log::channel('custom_log')->info('Sửa thành công bài viết: ' . $request->title);
            return redirect()->back()->with('success', 'Sửa thành công bài viết');

        } catch (Throwable $throw) {
            Log::channel('custom_log')->error($throw->getMessage());
            return redirect()->back()->with('errors', 'Không sửa được bài viết');
        }

       
    }


    /**
     * Xóa bài viết 
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return Illuminate/Contracts/View/View
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        $image = $post->imagepost;
        $image = $this->deleteImage($image, 'image', 'images');

        $post = Post::find($id)->delete();
        
        return redirect()->back()->with('success', 'Xoá bài viết thành công');
    }
    
    /**
     * Sắp xếp bài post
     *
     * @param  mixed $request
     * @return void
     */
    public function sort(Request $request)
    {
        // $categories = Category::find(1);

        // if ($categories) {
            $posts_ascending = Post::orderBy('id', 'ASC')->paginate(env('PAGE_FIVE'));
            return view('admin.post.sort')->with(compact('posts_ascending'));

        //     if (1 == 2) {
        //         $posts_decrease = Post::orderBy('id', 'DESC')->paginate(env('PAGE_FIVE'));
        //         return view('admin.post.sort')->with(compact('posts_decrease', 'categories'));
        //     }
        // }
    }
    
    /**
     * hiển thị các bài viết thuộc danh mục
     *
     * @param  mixed $id
     * @return void
     */
    public function postOfCategory($id)
    {
        $categories = Category::find($id);
        $posts = Post::where('category_id', $categories->id)->paginate(env('PAGE_FIVE'));
        return view('admin.post.postofcategory')->with(compact('categories', 'posts'));
    }

    
    /**
     * search bằng elasticsearch 
     *
     * @param  mixed $request
     * @return void
     */
    public function elasticsearchQueries(Request $request){

        $key= "tin";

        //should: hoac; must: va
        $posts = Post::searchByQuery(
            ["bool"=> ["must"=> [
                ["match"=> [
                    "title"=> $key
                    ]],
                ["match"=> [
                    "content"=> $key
                    ]] 
            ]]],$aggregations = null, ["id","title","content"], $limit = null, $offset = null,
            ["id"=>
                ["order"=>"desc"]
            ]
            );
        dd($posts);
        //dd($posts->getHits()["hits"][0]["_source"]['title']);

    }

    public function crop(){
      $path = 'files/';
      $file = $request->file('file');
      $new_image_name = 'UIMG'.date('Ymd').uniqid().'.jpg';
      $upload = $file->move(public_path($path), $new_image_name);
      if($upload){
          return response()->json(['status'=>1, 'msg'=>'Image has been cropped successfully.', 'name'=>$new_image_name]);
      }else{
            return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
      }
    }
}
