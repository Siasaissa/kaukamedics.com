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
<style>
@media (max-width: 576px) {
  .checkout_area .order_box,
  .checkout_area .billing_details {
    padding: 1rem;
  }
  .checkout_area .payment-details {
    margin-top: 1rem;
  }
  .checkout_area .primary-btn {
    width: 100%;
    padding: .75rem;
    font-size: 1rem;
  }
  .checkout_area .form-group {
    margin-bottom: .75rem;
  }
}
</style>
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
                                <p class="text-muted mt-2 mb-0">Selecting a method will show payment instructions before you confirm the order.</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->

    <!-- start footer Area -->
    @include('layouts.footer')
    <!-- End footer Area -->

    <div class="modal fade" id="paymentInstructionModal" tabindex="-1" role="dialog" aria-labelledby="paymentInstructionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentInstructionModalLabel">Payment Instructions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 id="instructionMethod" class="text-primary mb-3"></h6>
                    <div id="instructionContent" class="text-muted"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="primary-btn border-0" data-dismiss="modal">Close</button>
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

    <script>
    const paymentInstructions = {
        'M-Pesa': `
            <p class="mb-2">Use M-Pesa to complete your payment quickly from your phone.</p>
            <ol class="pl-3 mb-0">
                <li>Open your M-Pesa menu on your phone. *150*00#</li>
                <li>Select <strong>Lipa kwa Simu</strong> or merchant payment.</li>
                <li>Use business number <strong>5066500</strong>.</li>
                <li>Enter the amount to pay Tsh <strong>{{ number_format($total, 2) }}</strong>.</li>
                <li>Enter your order phone number as reference.</li>
                <li>Complete the payment and keep the confirmation message.</li>
            </ol>
        `,
        'CRDB BANK': `
            <p class="mb-2">Make your transfer or deposit to the CRDB bank account below.</p>
            <ul class="list-unstyled mb-0">
                <li><strong>Bank:</strong> CRDB BANK</li>
                <li><strong>Account Name:</strong> Kauka Medical Supplies</li>
                <li><strong>Account Number:</strong>015C000T5WU00</li>
                <li>Enter the amount to pay Tsh <strong>{{ number_format($total, 2) }}</strong>.</li>
                <li><strong>Reference:</strong> Use your full name or phone number</li>
            </ul>
        `,
        'NMB BANK': `
            <p class="mb-2">Use the following NMB bank details to complete your order payment.</p>
            <ul class="list-unstyled mb-0">
                <li><strong>Bank:</strong> NMB BANK</li>
                <li><strong>Account Name:</strong> Kauka Medical Supplies</li>
                <li><strong>Account Number:</strong> 25110033313</li>
                <li>Enter the amount to pay Tsh <strong>{{ number_format($total, 2) }}</strong>.</li>
                <li><strong>Reference:</strong> Use your full name or phone number</li>
            </ul>
        `
    };

    function showPaymentInstructions(method) {
        if (!paymentInstructions[method]) {
            return;
        }

        $('#instructionMethod').text(method);
        $('#instructionContent').html(paymentInstructions[method]);
        $('#paymentInstructionModal').modal('show');
    }

    $(document).ready(function(){
        $('input[name="payment_method"]').on('change', function(){
            showPaymentInstructions(this.value);
        });

        @if(session('show_instructions') && session('payment_method'))
            showPaymentInstructions(@json(session('payment_method')));
        @endif
    });
    </script>
</body>

</html>
