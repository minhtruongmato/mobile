@extends('admin.banner.base')
@section('action-content')

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Thêm Mới Banner</h3>
					@if(Session::has('error'))
						<p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}</p>
					@endif
				</div>
				<div class="box-body">
					<form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
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