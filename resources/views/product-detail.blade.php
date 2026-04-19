<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="img/fav.png">
	<meta name="author" content="CodePixar">
	<meta name="description" content="{{ $product->name }} medical product details">
	<meta name="keywords" content="{{ $product->name }}, medical equipment, hospital supplies">
	<meta charset="UTF-8">
	<base href="{{ url('/') }}/">
	<title>{{ $product->name }} | Kauka Medical Supplies</title>

	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body>

	@include('layouts.header')

	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>{{ $product->name }}</h1>
					<nav class="d-flex align-items-center">
						<a href="{{ route('index') }}">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="{{ route('products') }}">Products<span class="lnr lnr-arrow-right"></span></a>
						<a href="{{ route('products.show', $product->id) }}">Product Details</a>
					</nav>
				</div>
			</div>
		</div>
	</section>

	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_Product_carousel">
						<div class="single-prd-item">
							<img class="img-fluid" src="{{ $product->image_url }}" alt="{{ $product->name }}" onerror="this.onerror=null;this.src='{{ asset('img/defaultmedical.jpg') }}';" style="width:100%;max-height:460px;object-fit:contain;">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="{{ $product->image_url }}" alt="{{ $product->name }}" onerror="this.onerror=null;this.src='{{ asset('img/defaultmedical.jpg') }}';" style="width:100%;max-height:460px;object-fit:contain;">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="{{ $product->image_url }}" alt="{{ $product->name }}" onerror="this.onerror=null;this.src='{{ asset('img/defaultmedical.jpg') }}';" style="width:100%;max-height:460px;object-fit:contain;">
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{ $product->name }}</h3>
						<h2>TZS {{ number_format($product->price ?? 0, 2) }}</h2>
						<ul class="list">
							<li><a class="active" href="#"><span>Unit</span> : {{ $product->unit ?: 'Standard medical unit' }}</a></li>
							<li><a href="#"><span>Availability</span> : {{ isset($product->stock) && $product->stock !== null ? ($product->stock > 0 ? 'In Stock' : 'Out of Stock') : 'Available on request' }}</a></li>
						</ul>
						<p>{{ $productDescription }}</p>
						<div class="product_count">
							<label for="qty">Quantity:</label>
							<input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
							<button onclick="var result = document.getElementById('sst'); var sst = parseInt(result.value || 1, 10); result.value = sst + 1; return false;"
								class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
							<button onclick="var result = document.getElementById('sst'); var sst = parseInt(result.value || 1, 10); if (sst > 1) result.value = sst - 1; return false;"
								class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
						</div>
						<div class="card_area d-flex align-items-center">
							<a class="primary-btn" href="{{ route('add.to.cart', $product->id) }}">Add to Cart</a>
							<a class="icon_btn" href="{{ route('wishlist.add', $product->id) }}"><i class="lnr lnr-heart"></i></a>
							<a class="icon_btn" href="{{ route('products') }}"><i class="lnr lnr-arrow-left"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specifications</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Quality</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p>{{ $productDescription }}</p>
					<p>This product is supplied for healthcare facilities that need dependable medical equipment with practical day-to-day performance. It is selected to support safe handling, consistent operation, and trusted use across clinical and hospital environments.</p>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td><h5>Product Name</h5></td>
									<td><h5>{{ $product->name }}</h5></td>
								</tr>
								<tr>
									<td><h5>Unit</h5></td>
									<td><h5>{{ $product->unit ?: 'Standard unit' }}</h5></td>
								</tr>
								<tr>
									<td><h5>Price</h5></td>
									<td><h5>TZS {{ number_format($product->price ?? 0, 2) }}</h5></td>
								</tr>
								<tr>
									<td><h5>Stock</h5></td>
									<td><h5>{{ isset($product->stock) && $product->stock !== null ? $product->stock : 'Available on request' }}</h5></td>
								</tr>
								<tr>
									<td><h5>Quality Standard</h5></td>
									<td><h5>Professional medical supply grade</h5></td>
								</tr>
								<tr>
									<td><h5>Usage</h5></td>
									<td><h5>Hospitals, clinics, laboratories, pharmacies</h5></td>
								</tr>
								<tr>
									<td><h5>Supply Support</h5></td>
									<td><h5>Reliable sourcing and responsive delivery</h5></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<div class="row">
						<div class="col-lg-12">
							<div class="review_box">
								<h4>Why this medical equipment is trusted</h4>
								<ul class="list">
									@foreach ($productQualityPoints as $point)
										<li class="mb-2"><a href="#"><i class="fa fa-check text-success mr-2"></i>{{ $point }}</a></li>
									@endforeach
								</ul>
								<p class="mt-3">Kauka Medical Supplies focuses on dependable products that help healthcare teams operate efficiently, safely, and confidently in real treatment environments.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="related-product-area section_gap_bottom">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Related Medical Supplies</h1>
						<p>Explore more products frequently needed by healthcare facilities and medical teams.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9">
					<div class="row">
						@forelse ($relatedProducts as $relatedProduct)
							<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
								<div class="single-related-product d-flex">
									<a href="{{ route('products.show', $relatedProduct->id) }}">
										<img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name }}" style="width:70px;height:70px;object-fit:cover;" onerror="this.onerror=null;this.src='{{ asset('img/defaultmedical.jpg') }}';">
									</a>
									<div class="desc">
										<a href="{{ route('products.show', $relatedProduct->id) }}" class="title">{{ $relatedProduct->name }}</a>
										<div class="price">
											<h6>TZS {{ number_format($relatedProduct->price ?? 0, 2) }}</h6>
											@if($relatedProduct->unit)
												<h6 class="l-through">{{ $relatedProduct->unit }}</h6>
											@endif
										</div>
									</div>
								</div>
							</div>
						@empty
							<div class="col-12">
								<p class="text-center text-muted">No related products available right now.</p>
							</div>
						@endforelse
					</div>
				</div>
				<div class="col-lg-3">
					<div class="ctg-right">
						<a href="{{ route('products') }}">
							<img class="img-fluid d-block mx-auto" src="{{ $product->image_url }}" alt="{{ $product->name }}" onerror="this.onerror=null;this.src='{{ asset('img/defaultmedical.jpg') }}';">
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	@include('layouts.footer')

	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
