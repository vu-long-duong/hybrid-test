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
      <form class="navbar-form  form-search">
        <div class="form-group">
          <input class="form-control input-search-ajax" style="width: 30%;" id="keyword" name="keyword" placeholder="Search">
        </div>
      </form>

        <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" class="form-control mt-4" style="width: 30%;">
          <br>
          <button class="btn btn-success ">Import User Data</button>
          <div class="col">
            <a class="btn btn-warning mt-2 " href="{{ route('users.export') }}">Export User Data</a>
          </div>
          
        </form>
        
       
      

      <table class="table mt-4">

        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Verify </th>
            <th scope="col">Control</th>
          </tr>
        </thead>

        <tbody id="listUser">
          @foreach($listUser as $key => $value)

          <tr>
            <td scope="row">{{$value->id}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->email}}</td>
            <td>{{$value->email_verified_at }}</td>

            <td>

              <button class=" btn btn-danger btn-delete"> <a href="{{route('ad.user-delete',['id'=>$value->id])}}"> Delete</a></button>
            </td>

          </tr>

          @endforeach
        </tbody>

      </table>

    </div>
    @include('admin.category.edit')
</form>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

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

  })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $(document).on('keyup', '#keyword', function() {
      var keyword = $(this).val();
      $.ajax({
        type: "get",
        url: "/user-search",
        data: {
          keyword: keyword
        },
        dataType: "json",
        success: function(response) {
          $('#listUser').html(response);
        }
      });
    });
  });
</script>
@endsection