<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Kauka Medics</title>

	<!--
            CSS
            ============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body id="category">

	<!-- Start Header Area -->
	@include('layouts.header')
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shop Category page</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Fashon Category</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Browse Categories</div>
					<ul class="main-categories">
						@forelse($sidebarProducts as $sidebarProduct)
							<li class="main-nav-list">
								<a href="{{ route('products', ['query' => $sidebarProduct->name]) }}">
									<span class="lnr lnr-arrow-right"></span>{{ $sidebarProduct->name }}
									<span class="number">{{ $sidebarProduct->unit ? strtoupper($sidebarProduct->unit) : 'UNIT N/A' }}</span>
								</a>
							</li>
						@empty
							<li class="main-nav-list">
								<a href="#">
									<span class="lnr lnr-arrow-right"></span>No products available
									<span class="number">UNIT N/A</span>
								</a>
							</li>
						@endforelse
					</ul>
				</div>
				
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<form action="{{ route('products') }}" method="GET">
							@if(request('query'))
								<input type="hidden" name="query" value="{{ request('query') }}">
							@endif
							<input type="hidden" name="per_page" value="{{ $perPage ?? request('per_page', 12) }}">
							<select name="sort" onchange="this.form.submit()">
								<option value="latest" {{ ($sort ?? request('sort', 'latest')) === 'latest' ? 'selected' : '' }}>Latest products</option>
								<option value="price_asc" {{ ($sort ?? request('sort')) === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
								<option value="price_desc" {{ ($sort ?? request('sort')) === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
								<option value="name_asc" {{ ($sort ?? request('sort')) === 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
								<option value="name_desc" {{ ($sort ?? request('sort')) === 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
							</select>
						</form>
					</div>
					<div class="sorting mr-auto">
						<form action="{{ route('products') }}" method="GET">
							@if(request('query'))
								<input type="hidden" name="query" value="{{ request('query') }}">
							@endif
							<input type="hidden" name="sort" value="{{ $sort ?? request('sort', 'latest') }}">
							<select name="per_page" onchange="this.form.submit()">
								<option value="12" {{ (int) ($perPage ?? request('per_page', 12)) === 12 ? 'selected' : '' }}>Show 12</option>
								<option value="24" {{ (int) ($perPage ?? request('per_page', 12)) === 24 ? 'selected' : '' }}>Show 24</option>
								<option value="36" {{ (int) ($perPage ?? request('per_page', 12)) === 36 ? 'selected' : '' }}>Show 36</option>
							</select>
						</form>
					</div>
					<div class="mr-3 small text-white">
						Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }}
					</div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
						@forelse($products as $product)
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
                                @php
                                    $imagePath = trim((string) ($product->image ?? ''));
                                    $normalized = str_replace('\\', '/', $imagePath);
                                    $normalized = ltrim(str_replace(['storage/app/public/', 'storage/'], '', $normalized), '/');
                                    $imageUrl = asset('img/defaultmedical.jpg');

                                    if ($imagePath !== '') {
                                        if (\Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])) {
                                            $imageUrl = $imagePath;
                                        } elseif (file_exists(storage_path('app/public/' . $normalized))) {
                                        $imageUrl = asset('storage/app/public/' . $normalized);
                                        } elseif (file_exists(public_path('storage/' . $normalized))) {
                                        $imageUrl = asset('storage/' . $normalized);
                                        } elseif (file_exists(public_path($imagePath))) {
                                        $imageUrl = asset($imagePath);
                                        }
                                    }
                                @endphp
                                <div class="product-thumb-wrap">
                                    <img class="img-fluid" src="{{ $imageUrl }}" alt="{{ $product->name }}" onerror="this.onerror=null;this.src='{{ asset('img/defaultmedical.jpg') }}';" style="width:100%;height:220px;object-fit:cover;">
                                </div>
								<div class="product-details">
									<h6>{{ 
										// prefer 'name' then 'title'
										$product->name ?? $product->title ?? 'Product' 
									}}</h6>
									<div class="price">
										<h6>Tsh. {{ number_format($product->price ?? 0, 2) }}</h6>
										@if(!empty($product->old_price))
										<h6 class="l-through">Tsh. {{ number_format($product->old_price, 2) }}</h6>
										@endif
									</div>
									<div class="prd-bottom">

										<a href="{{ route('add.to.cart', $product->id) }}" class="social-info">
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
										<a href="{{ route('wishlist.add', $product->id) }}" class="social-info">
											<span class="lnr lnr-heart"></span>
											<p class="hover-text">Wishlist</p>
										</a>
										<a href="{{ route('products.show', $product->id) }}" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>
						@empty
						<div class="col-12">
							<div class="alert alert-light border text-center">
								No products found for your current filter.
							</div>
						</div>
						@endforelse
						<!-- end foreach -->
					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
						<p class="mb-0 text-white small">Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</p>
					</div>
					<div class="pagination">
						{{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
					</div>
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>

	<!-- Start related-product Area -->
	<section class="related-product-area section_gap">
		
	</section>
	<!-- End related-product Area -->

	<!-- start footer Area -->
	@include('layouts.footer')
	<!-- End footer Area -->

	<!-- Modal Quick Product View -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="container relative">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="product-quick-view">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<div class="quick-view-carousel">
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="quick-view-content">
								<div class="top">
									<h3 class="head">Mill Oil 1000W Heater, White</h3>
									<div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
									<div class="category">Category: <span>Household</span></div>
									<div class="available">Availibility: <span>In Stock</span></div>
								</div>
								<div class="middle">
									<p class="content">Mill Oil is an innovative oil filled radiator with the most modern technology. If you are
										looking for something that can make your interior look awesome, and at the same time give you the pleasant
										warm feeling during the winter.</p>
									<a href="#" class="view-full">View full Details <span class="lnr lnr-arrow-right"></span></a>
								</div>
								<div class="bottom">
									<div class="color-picker d-flex align-items-center">Color:
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
									</div>
									<div class="quantity-container d-flex align-items-center mt-15">
										Quantity:
										<input type="text" class="quantity-amount ml-15" value="1" />
										<div class="arrow-btn d-inline-flex flex-column">
											<button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
											<button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
										</div>

									</div>
									<div class="d-flex mt-20">
										<a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
										<a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
										<a href="#" class="like-btn"><span class="lnr lnr-heart"></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>
