@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<form action="{{route('ad.category-index')}}" method="get">
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
            <th scope="col">Name</th>
            <th scope="col">Slug Category</th>
            <th scope="col">Status</th>
            <th scope="col">Control</th>
          </tr>
        </thead>

        <tbody id="listCategory">
          @foreach($listCategory as $key => $value)

          <tr>

            <td scope="row" id='oke' class="oke">{{$value->id}}</td>
            <td> <a href="{{route('page.category-detail',['slug'=>$value->slug_category])}}">{{$value->name}} </a></td>
            <td>{{$value->slug_category}}</td>
            @if($value->status == 0)
            <td> <span class="badge bg-secondary">No Active</span></td>

            @elseif($value->status == 1)
            <td><span class="badge bg-success">Active</span></td>
            @endif
            
            <td>

              <a class="btn btn-warning btn-edit ml-2 " href="{{route('ad.category-edit',['id'=>$value->id])}}"> <i class="bi bi-pencil-square"></i> </a>
              <a class=" btn btn-danger btn-delete" href="{{route('ad.category-delete',['id'=>$value->id])}}"> <i class="bi bi-trash"></i></a>
            </td>

          </tr>

          @endforeach
        </tbody>

      </table>
      {{$listCategory->links()}}
    </div>
    @include('admin.category.edit')
</form>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {

    $('.btn-edit').click(function(e) {
      // var url = $(this).attr('href');

      $('#result').val($(this).closest('tr').find('td:first').text());
      alert(cateId);


      $('#modal-edit').modal('show');
      e.preventDefault();
      $.ajax({
        //phương thức get
        type: 'get',
        url: "/cat-edit/" + soHoaDon,
        success: function(response) {

          $('#name-category-edit').val(response.data.name);
          $('#slug-category-edit').val(response.data.slug_category);
          $('#status-category-edit').val(response.data.status);
        },
        error: function(error) {}
      })
    })




    $('#form-edit').submit(function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      $.ajax({
        type: 'post',
        url: url,
        data: {
          name: $('#name-category-edit').val(),
          slug_category: $('#slug-category-edit').val(),
          status: $('#status-category-edit').val(),
        },
        success: function(response) {
          // console.log(response.studentid)
          // toastr.success(response.message)
          $('#modal-edit').modal('hide');
          $('#name-category-' + response.categoryid).text(response.category.name)
          $('#slug-category-' + response.categoryid).text(response.category.slug_category)
          $('#status-category-' + response.categoryid).text(response.category.status)


        },
        error: function(jqXHR, textStatus, errorThrown) {
          //xử lý lỗi tại đây
        }
      })
    })



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
        url: "/cat-search",
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