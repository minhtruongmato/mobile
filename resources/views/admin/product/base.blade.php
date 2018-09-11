@extends('admin.layouts.master')
@section('content')

<section class="content-header">
    <h1>
        Sản Phẩm
        <small>Sản Phẩm</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sản Phẩm</li>
    </ol>
</section>

@yield('action-content')
<script type="text/javascript" src="{{ asset('public/admin/js/product.js') }}"></script>
@endsection
