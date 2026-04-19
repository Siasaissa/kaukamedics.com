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
    <title>Karma Shop</title>

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
    <style>
        .cart-product-cell .media {
            align-items: center;
        }

        .cart-quantity-form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .cart-quantity-form .quantity-input {
            width: 90px;
            min-width: 90px;
        }

        .cart-action-links {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .cart-summary-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .cart-summary-actions .primary-btn,
        .cart-summary-actions .gray_btn {
            margin-bottom: 0;
        }

        .cart-empty-state .btn {
            min-width: 220px;
        }

        @media (max-width: 767px) {
            .cart-product-cell .media {
                align-items: flex-start;
            }

            .cart-quantity-form,
            .cart-action-links,
            .cart-summary-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .cart-quantity-form .quantity-input,
            .cart-quantity-form .btn,
            .cart-summary-actions .primary-btn,
            .cart-summary-actions .gray_btn,
            .cart-empty-state .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    @include('layouts.header')

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $grandTotal = 0; @endphp
                        @if(!empty($cart) && count($cart) > 0)
                            @foreach($cart as $id => $item)
                                @php
                                    $qty = isset($item['quantity']) ? (int)$item['quantity'] : 1;
                                    $price = isset($item['price']) ? (float)$item['price'] : 0;
                                    $lineTotal = $price * $qty;
                                    $grandTotal += $lineTotal;

                                    // Resolve image url
                                    $imageUrl = asset('img/defaultmedical.jpg');
                                    if(!empty($item['image'])){
                                        $normalized = ltrim(str_replace(['storage/app/public/', 'storage/'], '', $item['image']), '/');
                                        if(Str::startsWith($item['image'], ['http://','https://'])){
                                            $imageUrl = $item['image'];
                                        } elseif(file_exists(storage_path('app/public/' . $normalized))){
                                            $imageUrl = asset('storage/app/public/' . $normalized);
                                        } elseif(file_exists(public_path($item['image']))){
                                            $imageUrl = asset($item['image']);
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td class="cart-product-cell">
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ $imageUrl }}" alt="{{ $item['name'] ?? 'Product' }}" style="width:80px; height:80px; object-fit:contain;">
                                            </div>
                                            <div class="media-body pl-3">
                                                <p>{{ $item['name'] ?? 'Product' }}</p>
                                                @if(!empty($item['notes']))
                                                    <small class="text-muted">{{ $item['notes'] }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>TZS {{ number_format($price, 2) }}</h5>
                                    </td>
                                    <td>
                                        <form action="{{ route('update.cart', $id) }}" method="POST" class="cart-quantity-form">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $qty }}" min="1" class="form-control quantity-input">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Update Quantity</button>
                                        </form>
                                    </td>
                                    <td>
                                        <h5>TZS {{ number_format($lineTotal, 2) }}</h5>
                                        <div class="cart-action-links">
                                            <a href="{{ route('remove.from.cart', $id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this item from cart?')">Remove Item</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            <!-- summary rows -->
                            <tr class="bottom_button">
                                <td></td>
                                <td></td>
                                <td colspan="2">
                                    <div class="cart-summary-actions">
                                        <a class="gray_btn" href="{{ route('products') }}">Continue Shopping</a>
                                        <a class="primary-btn" href="{{ route('checkout') }}">Proceed to checkout</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>TZS {{ number_format($grandTotal, 2) }}</h5>
                                </td>
                            </tr>
                            <tr class="shipping_area">
                                
                                
                            </tr>
                            <tr class="out_button_area">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                        @else
                            <tr>
                                <td colspan="4" class="text-center py-5 cart-empty-state">
                                    <h5>Your cart is empty.</h5>
                                    <p><a href="{{ route('products') }}" class="btn btn-primary mt-3">Browse Products</a></p>
                                </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

    @include('layouts.footer')

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
