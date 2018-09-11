@extends('admin.template.base')

@section('action-content')
<style type="text/css">
    .btn-config-close:hover{
        color: red;
        cursor: pointer;
    }
</style>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Chi tiết cấu hình</div>
                    @if(Session::has('error'))
                        <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}</p>
                    @endif
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('template.update', ['id' => $detail->id]) }}" enctype="multipart/form-data" id="config-form">
                            {{ csrf_field() }}
                            <div class="content-config">

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-2 control-label">Tên Cấu Hình</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control config-validate" name="title" value="{{ $detail->title }}" disabled >

                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <?php $i = 1 ?>
                                @foreach($detail['content'] as $key => $value)

                                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }} remove-config">
                                    <label for="content" class="col-md-2 control-label">Thông Số {{ $i++ }}</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control config-validate" name="content[{{ $key }}]" value="{{ $value }}" data-child="{{ $key }}" disabled>

                                        @if ($errors->has('content'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
