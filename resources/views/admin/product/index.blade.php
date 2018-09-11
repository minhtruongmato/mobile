@extends('admin.product.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <h3 class="box-title">Danh Sách Sản Phẩm</h3>
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
      <div class="col-sm-6"><a class="btn btn-primary" href="{{ route('product.create') }}">Thêm mới sản phẩm</a></div>
      <div class="col-sm-6">
        <form method="get" action="{{ route('product.index') }}">
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
                <th>Tên sản phẩm</th>
                <th>Giá thành</th>
                <th>Khuyến mại</th>
                <th>Nhóm sản phẩm</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($products as $item)
                <tr role="row" class="odd row-{{ $item['id'] }}">
                  <td class="sorting_1">{{ $item->title }}</td>
                  <td>{{ str_replace(',', '.', number_format($item->price, 0)) }}</td>
                  <td>{{ str_replace(',', '.', number_format($item->discount, 0)) }}</td>
                  <td>{{ $item->type_product->title }}</td>
                  <td  style="text-align: center;">
                    <a class="collapsed" data-toggle="collapse" href="#{{ $item->id }}" aria-expanded="true" aria-controls="messageContent" style="margin: 0px 10px; color: #3c8dbc" title="Chi Tiết">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('product.edit', ['id' => $item['id']]) }}" style="margin: 0px 10px; color: #f0ad4e" title="Chỉnh Sửa">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a href="javascript:void(0)" style="margin: 0px 10px; color: #d9534f" class="btn-remove" data-id="{{ $item['id'] }}" data-url="{{ route('product.remove', ['id' => $item['id']]) }}" title="Xóa">
                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                  </td>
              </tr>
              <tr class="row-{{ $item['id'] }}">
                <td colspan="7" class="no_border" style="padding: 0px">
                    <div class="collapse" id="{{ $item->id }}">
                      <div clas="row" style="padding: 8px">
                          <div class="col-md-5">
                              <?php $image = json_decode($item->image);?>
                              @if(is_array($image) == true)
                                @foreach ($image as $val)
                                  <img src=" {{ asset('storage/app/products/'. $item->slug.'/'.$val)}} " width=100>
                                @endforeach
                              @else
                                <img src=" {{ asset('storage/app/'. $item->image)}} " width=100>
                              @endif
                              <br />

                              <table class="table table-bordered table-hover dataTable">
                                <th colspan="2" style="background: #CEF3FB; text-align: center;">Thông Số Sản Phẩm</th>
                                <?php $stt = 1 ?>
                                  @foreach($item->template as $k => $val)
                                    <tr style="{{ ($stt % 2 == 0)? 'background: #B7FF9B' : '' }}">
                                      <td style="width: 50%;"><strong style="text-transform: capitalize;">{{ $k }}:</strong></td>
                                      <td>{{ $val }}</td>
                                    </tr>
                                  <?php $stt++ ?>
                                  @endforeach
                              </table>
                          </div>
                          <div class="col-md-7">
                              <table style="width: 100%">
                                  <tr>
                                      <td style="width: 50%;"><strong>Giới thiệu</strong></td>
                                      <td style="width: 50%;"><strong>Mô tả</strong></td>
                                  </tr>
                                  <tr>
                                      <td>{{ $item->description }}</td>
                                      <td>{!! $item->content !!}</td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                    </div>
                </td>
              </tr>
            @endforeach
            </tbody>
            @if(count($products) > 0)
            <tfoot>
              <tr>
                <th>Tên sản phẩm</th>
                <th>Giá thành</th>
                <th>Khuyến mại</th>
                <th>Nhóm sản phẩm</th>
                <th>Hành động</th>
              </tr>
            </tfoot>
            @endif
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Hiển thị  sản phẩm</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>
@endsection