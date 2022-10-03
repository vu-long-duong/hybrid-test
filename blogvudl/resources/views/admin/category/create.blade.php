@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Category</div>
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

                    <form method="POST" action="{{route('ad.category-store')}}" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Name Category</label>
                            <input type="text" class="form-control" name="name" onkeyup="ChangeToSlug();" id="slug" placeholder=" Write name category...." aria-describedby="emailHelp">
                        </div>

                        <div class="form-group mt-4">
                            <label for="exampleInputEmail1">Slug Category</label>
                            <input type="text" class="form-control" name="slug_category" id="convert_slug" aria-describedby="emailHelp">
                        </div>

                        <div class="form-group mt-4">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" class="custom-select form-control mt-2" id="inputGroupSelect01">
                                <option value="0">No Actve</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Create</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection