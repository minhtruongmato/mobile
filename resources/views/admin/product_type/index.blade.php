@extends('admin.product_type.base')
@section('action-content')

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh Sách Danh Mục</h3>
					@if(Session::has('error'))
						<p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}</p>
					@endif
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-sm-6"><a href="{{ route('product_type.create') }}" class="btn btn-primary">Thêm Mới Danh Mục</a></div>
						<div class="col-sm-6">
							{{-- <form method="get" action="{{ route('product_type.index') }}">
								<div class="row">
									<div class="col-xs-9">
										<input type="text" name="keyword" value="{{ $keyword }}" class="form-control" placeholder="Tìm kiếm ..." style="border-radius: 4px">
									</div>
									<div class="col-xs-2">
										<input type="submit" name="search" class="btn btn-info" value="Tìm Kiếm">
									</div>
								</div>
							</form> --}}
						</div>
					</div>
					<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
						<div class="row">
							<div class="col-sm-12">
								<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
									<thead>
										<tr role="row">
											<th>Tên danh mục</th>
											<th>Danh mục cha</th>
											<th>Cấp danh mục</th>
											<th>Hành động</th>
										</tr>
										<?php build_new_category($result, 0, ''); ?>
									</thead>
									<tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5">
								<div class="dataTables_info" id="example2_info" role="status" aria-live="polite"></div>
							</div>
							<div class="col-sm-7">
								<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
									{{ $result->links() }}
								</div>
							</div>
						</div>
					</div>
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
    function build_new_category($categorie, $parent_id = 0, $char = '', $sort = 1){
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
            <tr class="row-{{ $value['id'] }}">
            	<td><?php echo $char.$value['title'] ?></td>
            	<td><?php echo $value['parent_title'] ?></td>
            	<td><?php echo 'Danh mục cấp  <strong style="color: #3c8dbc">' . $sort. '</strong>' ?></td>
            	<td style="text-align: center;">
            		<a href="{{ route('product_type.edit', ['product_type' => $value['id']]) }}" style="margin: 0px 10px; color: #f0ad4e">
            			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            		</a>
            		<a href="javascript:void(0)" style="margin: 0px 10px; color: #d9534f" class="btn-remove" data-id="{{ $value['id'] }}" data-url="{{ route('product_type.remove', ['id' => $value['id']]) }}">
            			<i class="fa fa-trash-o" aria-hidden="true"></i>
            		</a>
            	</td>
            </tr>
            <?php build_new_category($categorie, $value['id'], $char.'---|', $sort + 1) ?>
            <?php
            }
        }
    }
?>

@endsection