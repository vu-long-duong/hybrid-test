@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<form action="{{route('ad.post-sort')}}" method="get">
  <div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="card-body">
      @if (session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
      <form class="navbar-form  form-search">
        <div class="form-group col-lg-3 col-sm-6" style="width: 20%;">

          <input class="form-control input-search-ajax "  id="keyword" name="keyword" placeholder="Search">
         
        </div>
        
      </form>
      <table class="table mt-4">

        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Summary</th>
            <th scope="col">Tag </th>
            <th scope="col">Image </th>
            <th scope="col">Status</th>
            <th scope="col">Control</th>
          </tr>
        </thead>

        <tbody id="listPost">
          @foreach($posts_ascending as $key => $value)
          <tr>
            <td scope="row">{{$value->id}}</td>
            <td> <a href="{{route('page.post-detail',['slug'=>$value->slug_post])}}">{{$value->title}}</a> </td>
            <td>{{$value->summary}}</td>
            @php
            $tags=$value->tag;

            $tags= explode(",",$tags);
            @endphp
            <td>
            @foreach($tags as $key => $tag)
            <span class="badge bg-warning text-dark">{{$tag}}</span>
            @endforeach
            </td>
            
            <td> <img src="{{asset('storage/images/'.$value->imagepost )}}" height="150" width="300"> </td>
            @if($value->status == 0)
            <td> <span class="badge bg-secondary">No Active</span></td>

            @elseif($value->status == 1)
            <td><span class="badge bg-success">Active</span></td>
            @endif
            
            <td>
              <button class="btn btn-warning btn-edit mb-2"><a href="{{route('ad.post-edit',['id' => $value->id])}}"> <i class="bi bi-pencil-square"></i></a> </button>
              <button class=" btn btn-danger btn-delete mb-4"> <a href="{{route('ad.post-delete',['id' => $value->id])}}"> <i class="bi bi-trash"></i></a></button>
            </td>

          </tr>

          @endforeach
        </tbody>

      </table>
      {{$posts_ascending->links()}}
    </div>
    @include('admin.category.edit')
</form>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $(document).on('keyup', '#keyword', function() {
      var keyword = $(this).val();
      $.ajax({
        type: "get",
        url: "/post-search",
        data: {
          keyword: keyword
        },
        dataType: "json",
        success: function(response) {
          $('#listPost').html(response);
        }
      });
    });
  });
</script>
@endsection