<div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-secondary top-bar wow fadeIn" data-wow-delay="0.1s">
        <div class="row align-items-center h-100">
            <div class="col-lg-4 text-center text-lg-start">
    <a href="/">
        <img src="{{ asset('img/logo.png') }}" 
             alt="Kauka Medics" 
             class="img-fluid" 
             style="height: 100px; filter: brightness(0) invert(1);">
    </a>
</div>

            <div class="col-lg-8 d-none d-lg-block">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <div class="flex-shrink-0 btn-square bg-primary">
                                <i class="fa fa-phone-alt text-white"></i>
                            </div>
                            <div class="ms-2">
                                <h6 class="text-primary mb-0">Call Us</h6>
                                <span class="text-white">+255 625 726 051</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <div class="flex-shrink-0 btn-square bg-primary">
                                <i class="fa fa-envelope-open text-white"></i>
                            </div>
                            <div class="ms-2">
                                <h6 class="text-primary mb-0">Mail Us</h6>
                                <span class="text-white">info@kaukamedics.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <div class="flex-shrink-0 btn-square bg-primary">
                                <i class="fa fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="ms-2">
                                <h6 class="text-primary mb-0">Address</h6>
                                <span class="text-white">Magomeni kanisani</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
    
    <!-- Notification Area -->
@if (session('success') || session('error'))
    <div id="alert-message"
        class="position-fixed top-0 end-0 mt-4 me-4 px-4 py-3 rounded-3 shadow-lg fade show"
        style="
            min-width: 320px;
            background-color: rgba({{ session('success') ? '40,167,69' : '220,53,69' }}, 0.9);
            color: #fff;
            backdrop-filter: blur(6px);
            z-index: 2000;
            transform: translateX(150%);
            transition: transform 0.5s ease, opacity 0.6s ease;
            opacity: 0;
        ">
        <div class="d-flex align-items-center">
            <i class="fa {{ session('success') ? 'fa-check-circle' : 'fa-exclamation-triangle' }} me-2 fs-5"></i>
            <div>
                <strong>{{ session('success') ? 'Success:' : 'Error:' }}</strong>
                <span>{{ session('success') ?? session('error') }}</span>
            </div>
        </div>
    </div>

    <script>
        // Animate toast entrance and fade-out
        document.addEventListener("DOMContentLoaded", () => {
            const alert = document.getElementById('alert-message');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '1';
                    alert.style.transform = 'translateX(0)';
                }, 100);

                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateX(150%)';
                    setTimeout(() => alert.remove(), 600);
                }, 4000);
            }
        });
    </script>
@endif

