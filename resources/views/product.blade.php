@extends('master')

@section('content')

<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Sản Phẩm</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="index.html">Trang Chủ</a> / <span>Sản Phẩm</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		<div class="row">
			<div class="col-sm-9">

				<div class="row">
					<div class="col-sm-4">
						<img src="{{ asset('storage/app/products/' . $detail['slug'] .'/'. json_decode($detail['image'])[0]) }}" alt="">
					</div>
					<div class="col-sm-8">
						<div class="single-item-body">
							<p class="single-item-title">{{ $detail['title'] }}</p>
							<p class="single-item-price">
								@if($detail['discount'] == 0)
									<span style="color: red">{{ number_format($detail['price']) }} VND</span>
								@else
									<span style="color: red">{{ number_format($detail['price'] - $detail['discount']) }} VND</span>
									<span style="text-decoration: line-through">{{ number_format($detail['price']) }} VND</span>
								@endif
							</p>
						</div>

						<div class="clearfix"></div>
						<div class="space20">&nbsp;</div>

						<div class="single-item-desc">
							<p>{{ $detail['description'] }}</p>
						</div>
						<div class="space20">&nbsp;</div>

						<p>Options:</p>
						<div class="single-item-options">
							<select class="wc-select" name="size">
								<option>Size</option>
								<option value="XS">XS</option>
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
							</select>
							<select class="wc-select" name="color">
								<option>Color</option>
								<option value="Red">Red</option>
								<option value="Green">Green</option>
								<option value="Yellow">Yellow</option>
								<option value="Black">Black</option>
								<option value="White">White</option>
							</select>
							<select class="wc-select" name="color">
								<option>Qty</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							<a class="add-to-cart" href="javascript:void(0)" data-id="{{ $detail['id'] }}" data-name="{{ $detail['title'] }}" data-price="{{ $detail['price'] -$detail['discount'] }}" data-url="{{ url('add-to-cart') }}" data-image="{{ json_decode($detail['image'])[0] }}"  data-slug="{{ $detail['slug'] }}">
								<i class="fa fa-shopping-cart"></i>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="space40">&nbsp;</div>
				<div class="woocommerce-tabs">
					<ul class="tabs">
						<li><a href="#tab-description">Description</a></li>
						<li><a href="#tab-reviews">Reviews (0)</a></li>
					</ul>

					<div class="panel" id="tab-description">
						{!! $detail['content'] !!}
					</div>
					<div class="panel" id="tab-reviews">
						<p>No Reviews</p>
					</div>
				</div>
				<div class="space50">&nbsp;</div>
				<div class="beta-products-list">
					<h4>Sản Phẩm Liên Quan</h4>

					<div class="row">
						@if($relatedProducts)
							@foreach($relatedProducts as $key => $value)
								@if($value['id'] != $detail['id'])
									<div class="col-sm-4">
										<div class="single-item">
											@if($value['discount'] != 0)
												<div class="ribbon-wrapper">
													<div class="ribbon sale">Sale</div>
												</div>
											@endif
											<div class="single-item-header">
												<a href="{{ url('san-pham/' . $value['slug']) }}"><img src="{{ asset('storage/app/products/' . $value['slug'] .'/'. json_decode($value['image'])[0]) }}" alt=""></a>
											</div>
											<div class="single-item-body">
												<p class="single-item-title">{{ $value['title'] }}</p>
												<p class="single-item-price" style="font-size: 15px">
													@if($value['discount'] == 0)
														<span class="flash-del">{{ number_format($value['price']) }} VND</span>
													@else
														<span class="flash-del">{{ number_format($value['price']) }} VND</span>
														<span class="flash-sale">{{ number_format($value['price'] - $value['discount']) }} VND</span>
													@endif
													
												</p>
											</div>
											<div class="single-item-caption">
												<a class="add-to-cart pull-left" href="javascript:void(0)"  data-id="{{ $value['id'] }}" data-name="{{ $value['title'] }}" data-price="{{ $value['price'] -$value['discount'] }}" data-url="{{ url('add-to-cart') }}" data-image="{{ json_decode($value['image'])[0] }}" data-slug="{{ $value['slug'] }}">
													<i class="fa fa-shopping-cart"></i>
												</a>
												<a class="beta-btn primary" href="{{ url('san-pham/' . $value['slug']) }}">Chi Tiết <i class="fa fa-chevron-right"></i></a>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								@endif
							@endforeach
						@endif
					</div>
				</div> <!-- .beta-products-list -->
			</div>
			<div class="col-sm-3 aside">
				<div class="widget">
					<h3 class="widget-title">Best Sellers</h3>
					<div class="widget-body">
						<div class="beta-sales beta-lists">
							<div class="media beta-sales-item">
								<a class="pull-left" href="product.html"><img src="{{ asset('public/source') }}/assets/dest/images/products/sales/1.png" alt=""></a>
								<div class="media-body">
									Sample Woman Top
									<span class="beta-sales-price">$34.55</span>
								</div>
							</div>
							<div class="media beta-sales-item">
								<a class="pull-left" href="product.html"><img src="{{ asset('public/source') }}/assets/dest/images/products/sales/2.png" alt=""></a>
								<div class="media-body">
									Sample Woman Top
									<span class="beta-sales-price">$34.55</span>
								</div>
							</div>
							<div class="media beta-sales-item">
								<a class="pull-left" href="product.html"><img src="{{ asset('public/source') }}/assets/dest/images/products/sales/3.png" alt=""></a>
								<div class="media-body">
									Sample Woman Top
									<span class="beta-sales-price">$34.55</span>
								</div>
							</div>
							<div class="media beta-sales-item">
								<a class="pull-left" href="product.html"><img src="{{ asset('public/source') }}/assets/dest/images/products/sales/4.png" alt=""></a>
								<div class="media-body">
									Sample Woman Top
									<span class="beta-sales-price">$34.55</span>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- best sellers widget -->
				<div class="widget">
					<h3 class="widget-title">Sản Phẩm Mới</h3>
					<div class="widget-body">
						<div class="beta-sales beta-lists">
							@if($newProducts)
								@foreach($newProducts as $key => $value)
									@if($value['id'] != $detail['id'])
										<div class="media beta-sales-item">
											<a class="pull-left" href="product.html"><img src="{{ asset('storage/app/products/' . $value['slug'] .'/'. json_decode($value['image'])[0]) }}" alt=""></a>
											<div class="media-body">
												{{ $value['title'] }}<br>
												<span class="beta-sales-price" style="font-size: 15px">{{ number_format($value['price'] - $value['discount']) }} VND</span>
											</div>
										</div>
									@endif
								@endforeach
							@endif
						</div>
					</div>
				</div> <!-- best sellers widget -->
			</div>
		</div>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection