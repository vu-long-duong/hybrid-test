@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Post</div>
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

                    <form method="POST" action="{{route('ad.post-update',['id'=>$post->id])}}" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control" name="title" onkeyup="ChangeToSlug();" id="slug" value="{{$post->title}}" placeholder=" Write name post...." aria-describedby="emailHelp">
                        </div>

                        <div class="form-group mt-4">
                            <label for="exampleInputEmail1">Slug post</label>
                            <input type="text" class="form-control" name="slug_post" id="convert_slug" value="{{$post->slug_post}}" placeholder=" Write name post...." aria-describedby="emailHelp">
                        </div>

                        <div class="form-group mt-4">
                            <label for="exampleInputEmail1">Summary</label>
                            <input type="text" class="form-control" name="summary" value="{{$post->summary}}" placeholder=" Write name sumary...." aria-describedby="emailHelp">
                        </div>

                        <div class="form-group mt-4">
                            <label for="exampleInputEmail1">Content</label>
                            <textarea type="text" class="form-control mt-4 ckeditor" rows="5" style="resize: none" value="{{$post->content}}" name="content" placeholder=" Write content post...." aria-describedby="emailHelp"></textarea>
                        </div>

                        <div class="form-group mt-4">
                            <label for="exampleInputEmail1">Tags</label>
                            <div class=" row container">
                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
                                <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
                                <div class="row   mt-100">
                                    <div class="col-md-6 mb-4">
                                        <select id="choices-multiple-remove-button" name="tag[]" placeholder="Select upto 5 tags" multiple>
                                        
                                            @foreach($tags as $key => $tag)
                                            <option value="{{$tag->id}}" @if(!empty($edit) && in_array($tag->id,$edit)) selected @endif >
                                                {{$tag->content ?? ''}}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                        <script>
                            function chooseFile(fileInput) {
                                if (fileInput.files && fileInput.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#image').attr('src', e.target.result)
                                    }
                                    reader.readAsDataURL(fileInput.files[0]);
                                }
                            }
                        </script>
                        <label class="form-control-label mt-4" for="input-address">Image:</label>
                        <br>
                        <input type="file" class="form-control-file" id="imagefile" name="image" onchange="chooseFile(this)" value="{{old('image')}}">

                        <img src="{{asset('storage/images/'.$post->imagepost )}}" id="image" height="200" width="160">

                        <div class="form-group mt-4">
                            <label for="exampleInputEmail1">In Category</label>
                            <select name="category" class="custom-select form-control mt-2">
                                @foreach($category as $key =>$cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group mt-4 ">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" class="custom-select  form-control mt-2" id="inputGroupSelect01">
                                <option value="0">No Actve</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount: 5,
            searchResultLimit: 5,
            renderChoiceLimit: 5
        });
    });
</script>

@endsection