@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<form action="{{route('ad.tag-index')}}" method="get">
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
      <table class="table">

        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Content</th>
            <th scope="col">Is Hot</th>
            <th scope="col">Status</th>
            <th scope="col">Control</th>
          </tr>
        </thead>

        <tbody id="listCategory">
          @foreach($listTag as $key => $value)

          <tr>

            <td scope="row" id='oke' class="oke">{{$value->id}}</td>
            <td>{{$value->content}}</td>

            @if($value->hot==0)
            <td><span class="badge bg-secondary">No Hot</span> </td>
            @elseif($value->hot==1)
            <td> <span class="badge bg-danger">Hot</span> </td>
            @endif



            @if($value->status == 0)
            <td> <span class="badge bg-secondary">No Active</span></td>

            @elseif($value->status == 1)
            <td><span class="badge bg-success">Active</span></td>
            @endif
            <td>

              <a class="btn btn-warning btn-edit ml-2 " href="{{route('ad.tag-edit',['id'=>$value->id])}}"> <i class="bi bi-pencil-square"></i> </a>
              <a class=" btn btn-danger btn-delete" href="{{route('ad.tag-delete',['id'=>$value->id])}}"> <i class="bi bi-trash"></i></a>
            </td>

          </tr>

          @endforeach
        </tbody>

      </table>
      {{$listTag->links()}}
    </div>
    @include('admin.category.edit')
</form>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
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
        url: "/tag-search",
        data: {
          keyword: keyword
        },
        dataType: "json",
        success: function(response) {
          $('#listCategory').html(response);
        }
      });
    });
  });
</script>
@endsection