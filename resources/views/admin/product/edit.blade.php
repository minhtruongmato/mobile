@extends('admin.product.base')
@section('action-content')

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Thêm Mới Sản Phẩm</h3>
					@if(Session::has('error'))
						<p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}</p>
					@endif
				</div>
				<div class="box-body">
					
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li role="presentation" class="active"><a href="#basi" aria-controls="basi" role="tab" data-toggle="tab">Thông Tin Cơ Bản</a></li>
						<li role="presentation"><a href="#config" aria-controls="config" role="tab" data-toggle="tab">Cấu Hình Sản Phẩm</a></li>
					</ul>

					<form action="{{ route('product.update',['id' => $detail->id]) }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
							<div class="tab-content">
	                            <div role="tabpanel" class="tab-pane active" id="basi">
									<div class="row">
										<div class="form-group col-md-12">
											<label for="image">Hình Ảnh Đang Sử Dụng</label><br />
											@foreach(json_decode($detail['image']) as $key => $value)
												<img src="{{ asset('storage/app/products/'. $detail->slug .'/'. $value) }}" width="100">
											@endforeach
										</div>

										<div class="form-group col-md-12{{ $errors->has('image') ? ' has-error' : '' }}">
											<label for="image">Hình Ảnh</label>
											<input type="file" name="image[]" value="" class="form-control" multiple>

											@if ($errors->has('image'))
											<span class="help-block">
												<strong>{{ $errors->first('image') }}</strong>
											</span>
											@endif
										</div>

										<div class="form-group col-md-12{{ $errors->has('title') ? ' has-error' : '' }}">
											<label for="title">Tiêu Đề</label>
											<input type="text" name="title" value="{{ $detail->title }}" class="form-control" id="title">

											@if ($errors->has('title'))
											<span class="help-block">
												<strong>{{ $errors->first('title') }}</strong>
											</span>
											@endif
										</div>

										<div class="form-group col-md-12{{ $errors->has('slug') ? ' has-error' : '' }}">
											<label for="slug">Slug</label>
											<input type="text" name="slug" value="{{ $detail->slug }}" class="form-control" readonly id="slug">

											@if ($errors->has('slug'))
											<span class="help-block">
												<strong>{{ $errors->first('slug') }}</strong>
											</span>
											@endif
										</div>

										<div class="form-group col-md-12{{ $errors->has('type_id') ? ' has-error' : '' }}">
											<label for="type_id">Danh Mục</label>
											<select name="type_id" class="form-control">
												<option value="">Chọn danh mục</option>
												<?php build_new_category($category, 0, $detail->type_id,'') ?>
											</select>

											@if ($errors->has('type_id'))
											<span class="help-block">
												<strong>{{ $errors->first('type_id') }}</strong>
											</span>
											@endif
										</div>

										<div class="form-group col-md-12{{ $errors->has('price') ? ' has-error' : '' }}">
											<label for="price">Giá Sản Phẩm (VND)</label>
											<input type="text" name="price" value="{{ $detail->price }}" class="form-control price_shared">

											@if ($errors->has('price'))
											<span class="help-block">
												<strong>{{ $errors->first('price') }}</strong>
											</span>
											@endif
										</div>

										<div class="form-group col-md-12{{ $errors->has('discount') ? ' has-error' : '' }}">
											<label for="discount">Giảm Giá (VND)</label>
											<input type="text" name="discount" value="{{ $detail->discount }}" class="form-control price_shared">

											@if ($errors->has('discount'))
											<span class="help-block">
												<strong>{{ $errors->first('discount') }}</strong>
											</span>
											@endif
										</div>
										
										<div class="form-group col-md-12{{ $errors->has('description') ? ' has-error' : '' }}">
											<label for="description">Giới thiệu</label>
											<textarea id="description" rows="10" class="form-control" name="description" value="{{ old('description') }}">{{ $detail->description }}</textarea>

											@if ($errors->has('description'))
											<span class="help-block">
												<strong>{{ $errors->first('description') }}</strong>
											</span>
											@endif
										</div>

										<div class="form-group col-md-12{{ $errors->has('content') ? ' has-error' : '' }}">
											<label for="content">Nội dung</label>
											<textarea id="content" rows="10" class="form-control tinymce" name="content" value="{{ old('content') }}">{{ $detail->content }}</textarea>

											@if ($errors->has('content'))
											<span class="help-block">
												<strong>{{ $errors->first('content') }}</strong>
											</span>
											@endif
										</div>
										
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="config">
									<div class="form-group col-md-12{{ $errors->has('template_id') ? ' has-error' : '' }}">
										<label for="template_id" class="col-md-2 control-label">Cấu Hình</label>
										<div class="col-md-4">
											<select name="template_id"  class="form-control template_id" >
	                                            <option value="">---------------------Chọn cấu hình---------------------</option>
	                                            @foreach($template as $value)
	                                                <option value="{{ $value->id }}" {{ ($detail->template_id == $value->id)? "selected" : "" }}>{{ $value->title }}</option>
	                                            @endforeach
	                                        </select>
	                                    </div>
									</div>
									<div class="template-content">
                                    	@foreach($detail->template as $key => $value)
                                            <div class="form-group col-md-12">
                                                <label for="content" class="col-md-2 control-label">{{ $key }}</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control config-validate" name="template_content[]" value="{{ $value }}">
                                                </div>
                                            </div>
                                        @endforeach
                                	</div>
								</div>
							</div>
							<div class="form-group">
	                            <div class="col-md-1 col-md-offset-11">
	                                <button type="submit" class="btn btn-primary">
	                                    OK
	                                </button>
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
    function build_new_category($categorie, $parent_id = 0, $type_id, $char = ''){
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
            <option value="<?php echo $value['id'] ?>" <?php echo ($value['id'] == $type_id)? 'selected' : '' ?> ><?php echo $char.$value['title'] ?></option>
            <?php build_new_category($categorie, $value['id'], $type_id, $char.'---|') ?>
            <?php
            }
        }
    }
?>

@endsection