@foreach($data as $key => $pro)
<div class="card" style="position: absolute;">
    <div class="card-body">
        <h5 class="card-title"><a href="{{route('page.post-detail',['slug'=>$pro->slug_post])}}"> {{$pro->title}}</a></h5>
        <p class="card-text"> {{Str::words(strip_tags($pro->summary),30)}}</p>
    </div>
</div>
@endforeach