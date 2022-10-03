@extends('layouts.app')
@section('content')
    @include('layouts.navbar')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Post</div>
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

                        <form method="POST" action="{{ route('ad.post-store') }}" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group ">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" name="title" onkeyup="ChangeToSlug();"
                                    id="slug" placeholder=" Write name post...." aria-describedby="emailHelp">
                            </div>

                            <div class="form-group mt-4">
                                <label for="exampleInputEmail1">Slug post</label>
                                <input type="text" class="form-control" name="slug_post" id="convert_slug"
                                    placeholder=" Write name post...." aria-describedby="emailHelp">
                            </div>

                            <div class="form-group mt-4">
                                <label for="exampleInputEmail1">Summary</label>
                                <input type="text" class="form-control" name="summary"
                                    placeholder=" Write name sumary...." aria-describedby="emailHelp">
                            </div>

                            <div class="form-group mt-4">
                                <label for="exampleInputEmail1">Content</label>
                                <textarea type="text" id="content1" class="form-control ckeditor" rows="5" style="resize: none" name="content"
                                    placeholder=" Write content post...." aria-describedby="emailHelp"></textarea>
                            </div>


                            <div class="form-group mt-4">
                                <label for="exampleInputEmail1">Tags</label>
                                <div class=" row container">
                                    <link rel="stylesheet"
                                        href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
                                    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
                                    <div class="row   mt-100">
                                        <div class="col-md-6 mb-4">
                                            <select id="choices-multiple-remove-button" name="tag[]"
                                                placeholder="Select upto 5 tags" multiple>
                                                @foreach ($tags as $key => $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->content }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <!-- ////// -->
                            <div class="container">
                                <br />
                                <h3>Image:</h3>
                                <br />

                                <div class="form-group">

                                    <input type="file" name="image" class="image form-control" id="upload_image" />
                                    <img src="upload/user.png" height="100" width="100" id="base64image"
                                        class="mt-2" />
                                </div>

                                <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Crop Image Before Upload</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">X</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="img-container">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <img src="" id="sample_image" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="preview"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="crop" class="btn btn-primary">Crop</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- //// -->
                            <div class="form-group mt-4">
                                <label for="exampleInputEmail1">In Category</label>
                                <select name="category" class="custom-select form-control mt-2">
                                    @foreach ($category as $key => $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                </select>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <script>
        $(document).ready(function() {
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount: 6,
                searchResultLimit: 5,
                renderChoiceLimit: 5,
            });


        });
        // function chooseFile(fileInput) {
        //     if (fileInput.files && fileInput.files[0]) {
        //         var reader = new FileReader();
        //         reader.onload = function(e) {
        //             $('#image').attr('src', e.target.result)
        //         }
        //         reader.readAsDataURL(fileInput.files[0]);
        //     }
        // }
    </script>
    <script>
        $(document).ready(function() {

            var $modal = $('#modal');

            var image = document.getElementById('sample_image');

            var cropper;

            $('#upload_image').change(function(event) {
                var files = event.target.files;

                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };

                if (files && files.length > 0) {
                    reader = new FileReader();
                    reader.onload = function(event) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);
                }
            });

            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            $('#crop').click(function() {
                canvas = cropper.getCroppedCanvas({
                    width: 150,
                    height: 300,
                });

                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $('#base64image').val(base64data);
                        $('#base64image').attr('src', base64data);
                        $modal.modal('hide');
                    };
                });
            });

        });
    </script>
    <?php
    
    ?>


@endsection
