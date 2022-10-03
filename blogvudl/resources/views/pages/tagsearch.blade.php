@extends('../welcome')
@section('content')


<div class="pd-top-80 pd-bottom-50" >
        <div class="container">
            <div class="section-title">
                        <h6 class="title"> Tìm kiếm với từ khóa là : "{{$slug}}"</h6>
            </div>
            
            <div class="row ">
                
                @foreach($tags as $key => $tag)
                <div class="col">
                    <div class="single-tag-wrap style-overlay">
                        <div class="thumb">
                            <img src="{{asset('storage/images/'.$tag->imagepost )}}" height="150" width="300" alt="img">
                            <a class="tag-base tag-purple" href="{{route('page.post-detail',['slug'=>$tag->posts->slug_post])}}">Xem</a>
                        </div>
                        <div class="details">
                            <div class="post-meta-single">
                                <p><i class="fa fa-clock-o"></i>{{$tag->created_at}}</p>
                            </div>
                            <h6 class="title"><a href="{{route('page.post-detail',['slug'=>$tag->posts->slug_post])}}">{{$tag->title}}</a></h6>
                        </div>
                    </div>
                </div>
                
                @endforeach
                
                @include('pages.sidebar')
                

            </div>
        </div>
    </div>
@endsection