@extends('master')

@section('content')

<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Danh Mục Sản Phẩm</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="index.html">Trang Chủ</a> / <span>Danh Mục</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-3">
					<ul class="aside-menu">
						<li><a href="#">Typography</a></li>
						<li><a href="#">Buttons</a></li>
						<li><a href="#">Dividers</a></li>
						<li><a href="#">Columns</a></li>
						<li><a href="#">Icon box</a></li>
						<li><a href="#">Notifications</a></li>
						<li><a href="#">Progress bars and Skill meter</a></li>
						<li><a href="#">Tabs</a></li>
						<li><a href="#">Testimonial</a></li>
						<li><a href="#">Video</a></li>
						<li><a href="#">Social icons</a></li>
						<li><a href="#">Carousel sliders</a></li>
						<li><a href="#">Custom List</a></li>
						<li><a href="#">Image frames &amp; gallery</a></li>
						<li><a href="#">Google Maps</a></li>
						<li><a href="#">Accordion and Toggles</a></li>
						<li class="is-active"><a href="#">Custom callout box</a></li>
						<li><a href="#">Page section</a></li>
						<li><a href="#">Mini callout box</a></li>
						<li><a href="#">Content box</a></li>
						<li><a href="#">Computer sliders</a></li>
						<li><a href="#">Pricing &amp; Data tables</a></li>
						<li><a href="#">Process Builders</a></li>
					</ul>
				</div>
				<div class="col-sm-9">
					<div class="beta-products-list">
						<h4 style="text-transform: capitalize;">{{ $productType['title'] }}</h4>
						<div class="beta-products-details">
							<p class="pull-left">{{ $totalProducts }} sản phẩm</p>
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@if($products)
								@foreach($products as $key => $value)
									<div class="col-sm-4">
										<div class="single-item">
											@if($value['discount'] != 0)
												<div class="ribbon-wrapper">
													<div class="ribbon sale">Sale</div>
												</div>
											@endif
											<div class="single-item-header">
												<a href="{{ url('san-pham/'. $value['slug']) }}"><img src="{{ asset('storage/app/products/' . $value['slug'] .'/'. json_decode($value['image'])[0]) }}" alt=""></a>
											</div>
											<div class="single-item-body">
												<p class="single-item-title">{{ $value['title'] }}</p>
												<p class="single-item-price" style="font-size: 15px">
													@if($value['discount'] == 0)
														<span style="color: red">{{ number_format($value['price']) }} VND</span>
													@else
														<span style="color: red">{{ number_format($value['price'] - $value['discount']) }} VND</span>
														<span style="text-decoration: line-through">{{ number_format($value['price']) }} VND</span>
													@endif
												</p>
											</div>
											<div class="single-item-caption">
												<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
												<a class="beta-btn primary" href="{{ url('san-pham/'. $value['slug']) }}">Chi Tiết <i class="fa fa-chevron-right"></i></a>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
						<div class="col-md-6 col-md-offset-3" style="text-align: center;">
							{{ $products->links() }}
						</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>
				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection