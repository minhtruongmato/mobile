@extends('admin.layouts.master')
@section('content')

<section class="content-header">
    <h1>
        Danh Mục
        <small>Danh Mục</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Danh Mục</li>
    </ol>
</section>

@yield('action-content')
<script type="text/javascript" src="{{ asset('public/admin/js/productType.js') }}"></script>
@endsection
