@extends('../welcome')
@section('content')


<div class="pd-top-80 pd-bottom-50">
    <div class="container">
        <div class="section-title">
            <h6 class="title">Tin tức: {{$categories->name}} </h6>
        </div>

        <div class="row ">
            @foreach($posts as $key => $post)
            <div class="col-lg-2">
                <div class="single-post-wrap style-overlay">
                    <div class="thumb">
                        <img src="{{asset('storage/images/'.$post->imagepost )}}" height="150" width="300" alt="img">
                        <a class="tag-base tag-purple" href="{{route('page.post-detail',['slug'=>$post->slug_post])}}">Xem</a>
                    </div>
                    <div class="details">
                        <div class="post-meta-single">
                            <p><i class="fa fa-clock-o"></i>{{$post->created_at}}</p>
                        </div>
                        <h6 class="title"><a href="{{route('page.post-detail',['slug'=>$post->slug_post])}}">{{Str::words(strip_tags($post->title),5)}}</a></h6>
                    </div>
                </div>
            </div>

            @endforeach

            

            
            @include('pages.sidebar')   
            
        </div>
        
        {{$posts->links()}}
    </div>
    
    
</div>

@endsection