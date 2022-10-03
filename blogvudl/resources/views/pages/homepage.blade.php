@extends('../welcome')
@section('content')
<!-- banner area start -->
<div class="banner-area banner-inner-1 bg-black" id="banner">
    <!-- banner area start -->
    <div class="banner-inner pt-5">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="thumb after-left-top">
                        <img src="{{asset('storage/images/'.$postnew->imagepost )}}" height="500" width="700" alt="img">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="banner-details mt-4 mt-lg-0">

                        <h2>{{$postnew->title}}</h2>
                        <p>{{$postnew->summary}} </p>
                        <a class="btn btn-blue" href="{{route('page.post-detail',['slug'=>$postnew->slug_post])}}">Read More</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- banner area end -->

    <div class="container">
        <div class="section-title style-white">
            <h6 class="title">Posts new</h6>
        </div>
        <div class="row">
            @foreach($posts as $key => $post)
            <div class="col-lg-3 col-sm-6">

                <div class="single-post-wrap style-white">
                    <div class="thumb">
                        <img src="{{asset('storage/images/'.$post->imagepost )}}" height="150" width="300" alt="img">

                        <a class="tag-base tag-blue" href="{{route('page.post-detail',['slug'=>$post->slug_post])}}">Xem </a>
                    </div>
                    <div class="details">
                        <h6 class="title"><a href="{{route('page.post-detail',['slug'=>$post->slug_post])}}">{{$post->title}}</a></h6>
                        <div class="post-meta-single mt-3">
                            <ul>
                                <li><i class="fa fa-clock-o"></i>{{$post->created_at }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- banner area end -->

<div class="post-area pd-top-75 pd-bottom-50" id="trending">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="section-title">
                    <h6 class="title">Category Featured</h6>
                </div>

                <div class="post-slider owl-carousel">
                    @foreach($categories as $key => $cate)
                    <div class="item">

                        <div class="trending-post">
                            <div class="single-post-wrap style-overlay">
                                <div class="thumb">
                                    <img src="{{asset('img/post/5.png')}}" alt="img">
                                </div>
                                <div class="details">
                                    <div class="post-meta-single">
                                        <p><i class="fa fa-clock-o"></i>{{$cate->created_at}}</p>
                                    </div>
                                    <h6 class="title"><a href="{{route('page.category-detail',['slug'=>$cate->slug_category])}}">{{$cate->name}}</a></h6>
                                </div>
                            </div>

                        </div>

                    </div>
                    @endforeach


                </div>
            </div>

            @include('pages.sidebar')
        </div>

    </div>
</div>
</div>



<div class="pd-top-80 pd-bottom-50" id="grid">
    <div class="container">
        <div class="section-title">
            <h6 class="title">News Posts </h6>
        </div>

        <div class="row">



            @foreach($posts as $key => $post)
            <div class="col-lg-3 col-sm-6">
                <div class="single-post-wrap style-overlay">
                    <div class="thumb">
                        <img src="{{asset('storage/images/'.$post->imagepost )}}" height="150" width="300" alt="img">
                    </div>
                    <div class="details">
                        <div class="post-meta-single">
                            <p><i class="fa fa-clock-o"></i>{{$post->created_at}}</p>
                        </div>
                        <h6 class="title"><a href="{{route('page.post-detail',['slug'=>$post->slug_post])}}">{{$post->title}}</a></h6>
                    </div>
                </div>
            </div>

            @endforeach



        </div>
    </div>
</div>
@endsection