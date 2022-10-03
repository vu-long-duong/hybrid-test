@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<form action="{{route('ad.post-ofcategory',['id'=>$categories->id])}}" method="get">
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

      <table class="table mt-4">

        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Summary</th>
            <th scope="col">Image </th>
            <th scope="col">Status</th>
            <th scope="col">Control</th>
          </tr>
        </thead>

        <tbody id="listPost">
          @foreach($posts as $key => $value)

          <tr>
            <td scope="row">{{$value->id}}</td>
            <td> <a href="">{{$value->title}} </td>
            <td>{{$value->summary}}</td>


            <td> <img src="{{asset('storage/images/'.$value->imagepost )}}" height="150" width="300"> </td>
            @if($value->status == 0)
            <td>No Active</td>
            @elseif($value->status == 1)
            <td>Active</td>

            @endif

            <td>
              <a class="btn btn-warning btn-edit mb-2" href="{{route('ad.post-edit',['id' => $value->id])}}"> <i class="bi bi-pencil-square"></i></a> 
              <a class=" btn btn-danger btn-delete mb-4" href="{{route('ad.post-delete',['id' => $value->id])}}"> <i class="bi bi-trash"></i></a>
            </td>

          </tr>

          @endforeach
        </tbody>

      </table>
      {{$posts->links()}}
    </div>

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