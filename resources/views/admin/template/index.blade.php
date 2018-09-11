@extends('admin.template.base')
@section('action-content')
<!-- Main content -->
<section class="content">
   <div class="box">
      <div class="box-header">
         <h3 class="box-title">Danh Sách Cấu Hình</h3>
         @if(Session::has('error'))
         <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>
         @endif
         @if(Session::has('success'))
         <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>
         @endif
      </div>
      <!-- /.box-header -->
      <div class="box-body">
         <div class="row">
            <div class="col-sm-6"><a href="{{ route('template.create') }}" class="btn btn-primary">Thêm Mới Cấu Hình</a></div>
            <div class="col-sm-6">
               <form method="get" action="{{ route('template.index') }}">
                  <div class="row">
                     <div class="col-xs-9">
                        <input type="text" name="keyword" value="{{ $keyword }}" class="form-control" placeholder="Tìm kiếm ..." style="border-radius: 4px">
                     </div>
                     <div class="col-xs-2">
                        <input type="submit" name="search" class="btn btn-info" value="Tìm Kiếm">
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
               <div class="col-sm-12">
                  <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                     <thead>
                        <tr role="row">
                           <th>N0</th>
                           <th>Tên Cấu Hình</th>
                           <th>Hành động</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $i = 1 ?>
                        @foreach($templates as $value)
                        <tr role="row" class="odd row-{{ $value['id'] }}">
                           <td>{{ $i++ }}</td>
                           <td class="sorting_1">{{ $value['title'] }}</td>
                           <td  style="text-align: center;">
                              <a href="{{ route('template.show', ['id' => $value['id']]) }}" style="margin: 0px 10px; color: #3c8dbc" title="Chi Tiết">
                                 <i class="fa fa-eye" aria-hidden="true"></i>
                              </a>
                              <a href="{{ route('template.edit', ['id' => $value['id']]) }}" style="margin: 0px 10px; color: #f0ad4e" title="Chỉnh Sửa">
                                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </a>
                              <a href="javascript:void(0)" style="margin: 0px 10px; color: #d9534f" class="btn-remove" data-id="{{ $value['id'] }}" data-url="{{ route('template.remove', ['id' => $value['id']]) }}" title="Xóa">
                                 <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                           <th>N0</th>
                           <th>Tên Cấu Hình</th>
                           <th>Hành động</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-5">
                  <div class="dataTables_info" id="example2_info" role="status" aria-live="polite"></div>
               </div>
               <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                     {{ $templates->links() }}
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /.box-body -->
   </div>
</section>
<!-- /.content -->
@endsection