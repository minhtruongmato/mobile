@extends('admin.layouts.master')
@section('content')

<section class="content-header">
    <h1>
        Thành Viên
        <small>Thông Tin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Thành Viên</li>
    </ol>
</section>

@yield('action-content')

@endsection
