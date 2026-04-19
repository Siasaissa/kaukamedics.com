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
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <!-- Start Header Area -->
	@include('layouts.header')
	<!-- End Header Area -->

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="returning_customer">
            </div>
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>

                        <!-- Flash / validation messages -->
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Checkout form: posts to CheckoutController@process -->
                        <form id="checkoutForm" class="row contact_form" action="{{ route('checkout.process') }}" method="POST" novalidate="novalidate">
                            @csrf

                            <div class="col-md-6 form-group p_star">
                                <input required type="text" class="form-control" id="first" name="name" value="{{ old('name') }}" placeholder="Full name">
                                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <input required type="text" class="form-control" id="number" name="phone" value="{{ old('phone') }}" placeholder="Phone number">
                                @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <input required type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address">
                                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input required type="text" class="form-control" id="add1" name="address" value="{{ old('address') }}" placeholder="Address line 01">
                                @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input required type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" placeholder="Town/City">
                                @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-12 mt-3">
                                <!-- payment selection included in right column order box as radios. This button will finalize order -->
                                <button type="submit" class="primary-btn">Confirm Order</button>
                            </div>
                        </form>

                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">Product <span>Total</span></a></li>
                                @php
                                    $total = 0;
                                @endphp
                                @if(!empty($cart) && count($cart) > 0)
                                    @foreach($cart as $id => $item)
                                        @php
                                            $qty = isset($item['quantity']) ? (int)$item['quantity'] : 1;
                                            $price = isset($item['price']) ? (float)$item['price'] : 0;
                                            $line = $price * $qty;
                                            $total += $line;
                                        @endphp
                                        <li>
                                            <a href="#">{{ $item['name'] ?? 'Product' }} <span class="middle">x {{ $qty }}</span> <span class="last">TZS {{ number_format($line, 2) }}</span></a>
                                        </li>
                                    @endforeach
                                @else
                                    <li><a href="#">No items in your cart</a></li>
                                @endif
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Subtotal <span>TZS {{ number_format($total, 2) }}</span></a></li>
                                <li><a href="#">Shipping <span>Flat rate: TZS 2,000</span></a></li>
                                <li><a href="#">Total <span>TZS {{ number_format($total + 2000, 2) }}</span></a></li>
                            </ul>
                            <div class="payment_item mt-4">
                                <h4 class="mb-3">Select Payment Method</h4>
                                <div class="mb-2">
                                    <label class="d-flex align-items-center mb-2" for="payment_mpesa" style="cursor:pointer;">
                                        <input type="radio" id="payment_mpesa" name="payment_method" value="M-Pesa" form="checkoutForm" {{ old('payment_method') === 'M-Pesa' ? 'checked' : '' }}>
                                        <span class="ml-2">M-Pesa</span>
                                    </label>
                                </div>
                                <div class="mb-2">
                                    <label class="d-flex align-items-center mb-2" for="payment_crdb" style="cursor:pointer;">
                                        <input type="radio" id="payment_crdb" name="payment_method" value="CRDB BANK" form="checkoutForm" {{ old('payment_method') === 'CRDB BANK' ? 'checked' : '' }}>
                                        <span class="ml-2">CRDB BANK</span>
                                    </label>
                                </div>
                                <div class="mb-2">
                                    <label class="d-flex align-items-center mb-2" for="payment_nmb" style="cursor:pointer;">
                                        <input type="radio" id="payment_nmb" name="payment_method" value="NMB BANK" form="checkoutForm" {{ old('payment_method') === 'NMB BANK' ? 'checked' : '' }}>
                                        <span class="ml-2">NMB BANK</span>
                                    </label>
                                </div>
                                @error('payment_method')<small class="text-danger d-block">{{ $message }}</small>@enderror
                                @php
    $method = session('payment_method');
    $orderTotal = $total + 2000;
@endphp
@if (session('show_instructions') && $method)
    <div class="payment-details mt-3 p-3 border rounded bg-light">
        @if ($method === 'M-Pesa')
            <p>To complete your payment via <strong>M-Pesa</strong>:</p>
            <ol>
                <li>Dial <code>*150*00#</code></li>
                <li>Select <strong>Pay by M-Pesa</strong></li>
                <li>Lipa Namba: <strong>5066500</strong></li>
                <li>Enter Amount: Tsh {{ number_format($orderTotal, 2) }}</li>
            </ol>
        @elseif ($method === 'CRDB BANK')
            <p>To complete your payment via <strong>CRDB BANK</strong>:</p>
            <ol>
                <li>Account Number: <strong>015C000T5WU00</strong></li>
                <li>Enter Amount: Tsh {{ number_format($orderTotal, 2) }}</li>
            </ol>
        @else
            <p>To complete your payment via <strong>NMB BANK</strong>:</p>
            <ol>
                <li>Account Number: <strong>25110033313</strong></li>
                <li>Enter Amount: Tsh {{ number_format($orderTotal, 2) }}</li>
            </ol>
        @endif
    </div>
@endif
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
    
</body>

</html>
