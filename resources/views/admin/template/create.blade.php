@extends('admin.template.base')
@section('action-content')

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Thêm Mới Thông Số</h3>
					@if(Session::has('error'))
						<p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}</p>
					@endif
				</div>
				<div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('template.store') }}" enctype="multipart/form-data" id="config-form">
                            {{ csrf_field() }}
                            <div class="content-config">
                                <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                                    <label for="total" class="col-md-2 control-label">Số Fields</label>

                                    <div class="col-md-7">
                                        <input type="number" class="form-control" name="total" value="{{ old('total') }}" id="total" autofocus>
                                    </div>
                                    <div class="col-md-1">
                                        <a class="btn btn-primary" id="btn-total">ok</a>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-2 control-label">Tên Cấu Hình</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control config-validate" name="title" value="{{ old('title') }}" >

                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }} remove-config">
                                    <label for="content" class="col-md-2 control-label">Thông Số</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control config-validate" name="content[0]" value="{{ old('content') }}" data-child="0">

                                        @if ($errors->has('content'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    {{-- <div class="col-md-1" style="padding-top: 7px">
                                        <i class="fa fa-times-circle btn-config-close" aria-hidden="true"></i>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-9">
                                    <button type="submit" class="btn btn-primary btn-submit-config">
                                        Thêm Mới
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