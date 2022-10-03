@extends('../welcome')
@section('content')
<div class="post-area pd-top-75 pd-bottom-50" id="trending">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="section-title">
                    <h6 class="title">{{$posts->title}}</h6>
                </div>

                <div class="details">
                    <div class="post-meta-single">
                        <p><i class="fa fa-clock-o"></i>{{$posts->created_at}}</p>
                    </div>
                </div>
                <img src="{{asset('storage/images/'.$posts->imagepost )}}" height="600" width="800">
                          
                <div class="mt-4">
                    {{$posts->content}}
                </div>

            </div>
            @include('pages.sidebar')

        </div>
        
        <h5 class="title"> Tags: </h5>
        
        <button class="btn btn-outline-secondary"><a href="#"></a></button>
        
    </div>
</div>
</div>

@endsection