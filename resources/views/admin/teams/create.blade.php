@extends('admin.teams.base')
@section('action-content')

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Thêm Mới Thành Viên</h3>
					@if(Session::has('error'))
						<p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}</p>
					@endif
				</div>
				<div class="box-body">
					<form action="{{ route('teams.store') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">

							<div class="form-group col-md-12">
								<label for="image">Hình Ảnh</label><br>
								<input type="file" name="image">

								@if ($errors->has('image'))
								<span class="help-block">
									<strong>{{ $errors->first('image') }}</strong>
								</span>
								@endif
							</div>

							<div class="form-group col-md-12">
								<label for="slug">Slug</label>
								<input type="text" name="slug" value="{{ old('slug') }}" class="form-control" readonly id="slug">

								@if ($errors->has('slug'))
								<span class="help-block">
									<strong>{{ $errors->first('slug') }}</strong>
								</span>
								@endif
							</div>

							<div class="form-group col-md-12">
								<label for="title">Họ Tên</label>
								<input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title">

								@if ($errors->has('title'))
								<span class="help-block">
									<strong>{{ $errors->first('title') }}</strong>
								</span>
								@endif
							</div>

							<div class="form-group col-md-12">
								<label for="title">Chức Vụ</label>
								<input type="text" name="position" value="{{ old('position') }}" class="form-control">

								@if ($errors->has('position'))
								<span class="help-block">
									<strong>{{ $errors->first('position') }}</strong>
								</span>
								@endif
							</div>

							<div class="form-group col-md-12">
								<label for="description">Giới Thiệu</label>
								<textarea rows="10" class="form-control" name="description" >{{ old('description') }}</textarea>
							</div>

							<div class="form-group">
                                <div class="col-md-1 col-md-offset-11">
                                    <button type="submit" class="btn btn-primary">
                                        OK
                                    </button>
                                </div>
                            </div>
						</div>
					</form>
				</div>
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	<!-- END ACCORDION & CAROUSEL-->
</section>

@endsection