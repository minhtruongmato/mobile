@extends('admin.product_type.base')
@section('action-content')

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Thêm Mới Danh Mục</h3>
					@if(Session::has('error'))
						<p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}</p>
					@endif
				</div>
				<div class="box-body">
					<form action="{{ route('product_type.store') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">
							<div class="form-group col-md-12">
								<label for="title">Tiêu Đề</label>
								<input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title">

								@if ($errors->has('title'))
								<span class="help-block">
									<strong>{{ $errors->first('title') }}</strong>
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
								<label for="parent_id">Danh Mục</label>
								<select name="parent_id" class="form-control">
									<option value="0">Danh mục gốc</option>
									<?php build_new_category($category, 0, '') ?>
								</select>

								@if ($errors->has('position'))
								<span class="help-block">
									<strong>{{ $errors->first('position') }}</strong>
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

<?php 
    function build_new_category($categorie, $parent_id = 0, $char = ''){
        $cate_child = array();
        foreach ($categorie as $key => $item){
            if ($item['parent_id'] == $parent_id){
                $cate_child[] = $item;
                unset($categorie[$key]);
            }
        }
        if ($cate_child){
            foreach ($cate_child as $key => $value){
            ?>
            <option value="<?php echo $value['id'] ?>" ><?php echo $char.$value['title'] ?></option>
            <?php build_new_category($categorie, $value['id'], $char.'---|') ?>
            <?php
            }
        }
    }
?>

@endsection