<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="" id="form-edit" method="POST" role="form">
				<div class="modal-header">
					<h4 class="modal-title">Cập nhật</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
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

					<div class="form-group">
						<label for="">Name Category</label>
						<input type="text" class="form-control" id="name-category-edit"  placeholder="Write name Category...">
					</div>

                    <div class="form-group">
						<label for="">Slug Category</label>
						<input type="text" class="form-control" id="slug-category-edit"  placeholder="Nhập slug">
					</div>
					<div class="form-group">
						<label for="">Status</label>
						<select name="status" id="status-category-edit" class="form-control"  required="required">
							<option value="0">No Active</option>
							<option value="1">Active</option>
						</select>
					</div>





				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary"> <a href="">  Edit </a></button>

				</div>
			</form>
		</div>
	</div>
</div>