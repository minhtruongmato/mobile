@extends('admin.layouts.master')
@section('content')

<section class="content-header">
    <h1>
        Banner
        <small>Banner</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Banner</li>
    </ol>
</section>

@yield('action-content')

@endsection
