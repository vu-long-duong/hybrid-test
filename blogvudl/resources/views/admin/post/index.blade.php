@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<form action="{{route('ad.post-index')}}" method="get">
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

          <div class="container px-4">
            <div class="row gx-5">
              <div class="col">
                <div class="form-group " >
                <input class="form-control input-search-ajax mb-4 " style="width: 50%;" id="keyword" name="keyword" placeholder="Search">
                </div>
              </div>
              
              <div class="col">
                <form class="form-group">
                  <input class="form-control me-2" name='search' style="width: 50%;" type="search" placeholder="Search by elastichsearch" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
              
            </div>
          </div>
      
          <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" name="sort-asc" class="btn btn-outline-info"> <a href="{{route('ad.post-sort')}}"> ASC </a></button>
            <button type="button" name='sort-desc' class="btn btn-outline-info"> <a href="{{route('ad.post-sort')}}"> DESC </a></button>
          </div>   
        </div>

        <form action="{{ route('posts.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" class="form-control mt-4" style="width: 30%;">
          <br>
          <button class="btn btn-success ">Import Post Data</button>
        </form>
        <form action="{{ route('posts.export') }}" method="GET" enctype="multipart/form-data">
          @csrf
          <div class="col">
            <label class='mt-4'>
            For
            <input type="date" name="mindate" min="" />
            to
            <input type="date" name="maxdate" min="" />
            </label>
            </br>

          </div>
          <br>
          <button class="btn btn-warning mt-2 ">Export Post Data</button>
        </form>
          
          
        

      <table class="table mt-4">

        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Summary</th>
            <th scope="col">Category </th>
            <th scope="col">Image </th>
            <th scope="col">Tag </th>
            <th scope="col">Status</th>
            <th scope="col">Control</th>
          </tr>
        </thead>

        @foreach($listPost as $key => $value)
        <tbody id="listPost" class="mt-4">

          <tr>
            <td scope="row">{{$value->id}}</td>
            <td><a href="{{route('page.post-detail',['slug'=>$value->slug_post])}}">{{$value->title}}</a></td>
            <td>{{$value->summary}}</td>

            <td><a href="{{route('ad.post-ofcategory',['id'=>$value->categories->id])}}">{{$value->categories->name}} </a> </td>
            <td> <img src="{{asset('storage/images/'.$value->imagepost )}}" height="150" width="300"> </td>

            <td>
              @foreach ($tags as $tag) 
              <span class="badge bg-warning text-dark"> {{$tag->content}} </span>
              @endforeach
              
            </td>

            @if($value->status == 0)
            <td> <span class="badge bg-secondary">No Active</span></td>

            @elseif($value->status == 1)
            <td><span class="badge bg-success">Active</span></td>
            @endif

            <td>
              <a class="btn btn-warning btn-edit mb-2" href="{{route('ad.post-edit',['id' => $value->id])}}"> <i class="bi bi-pencil-square"></i></a>
              <a class=" btn btn-danger btn-delete mb-4" href="{{route('ad.post-delete',['id' => $value->id])}}"> <i class="bi bi-trash"></i></a>
            </td>

          </tr>


        </tbody>
        @endforeach

      </table>
      {{$listPost->links()}}
    </div>
    @include('admin.category.edit')
</form>


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

  $('.btn-delete').click(function() {
    var url = $(this).attr('href');
    var _this = $(this);
    if (confirm('Are you sure you want to delete?')) {
      $.ajax({
        type: 'delete',
        url: url,
        success: function(response) {
          _this.parent().parent().remove();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          //xử lý lỗi tại đây
        }
      })
    }
  })
</script>
@endsection