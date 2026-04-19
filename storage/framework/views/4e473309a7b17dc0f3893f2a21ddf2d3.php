<div class="container-fluid bg-secondary px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="nav-bar">
        <nav class="navbar navbar-expand-lg bg-primary navbar-dark px-4 py-lg-0">
            <h4 class="d-lg-none m-0">Menu</h4>
            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav me-auto">
                    <a href="<?php echo e(route('index')); ?>"
                        class="nav-item nav-link <?php echo e(Route::is('index') ? 'active' : ''); ?>">Home</a>
                    <a href="<?php echo e(route('about')); ?>"
                        class="nav-item nav-link <?php echo e(Route::is('about') ? 'active' : ''); ?>">About</a>
                    <a href="<?php echo e(route('service')); ?>"
                        class="nav-item nav-link <?php echo e(Route::is('service') ? 'active' : ''); ?>">Service</a>
                    <a href="<?php echo e(route('contact')); ?>"
                        class="nav-item nav-link <?php echo e(Route::is('contact') ? 'active' : ''); ?>">Contact</a>
                    <a href="<?php echo e(route('products')); ?>"
                        class="nav-item nav-link <?php echo e(Route::is('products') ? 'active' : ''); ?>">Products</a>
                </div>
                <div class="d-flex ms-auto align-items-center">
                    <?php if(Route::is('products')): ?>
                        <!-- Cart Icon for Products Page -->
                        <a class="btn btn-square btn-primary ms-3 position-relative" href="<?php echo e(route('cart')); ?>">
                            <i class="bi bi-cart3 fs-5 text-white"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo e(session('cart') ? count(session('cart')) : 0); ?>

                            </span>
                        </a>
                    <?php else: ?>
                        <!-- Social Icons for Other Pages 
                        <a class="btn btn-square btn-dark ms-2" href="#!"><i class="fab fa-twitter"></i></a>-->
                        <a class="btn btn-square btn-dark ms-2" href="https://www.facebook.com/ambwenekauka/"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-dark ms-2" href="https://www.instagram.com/kauka_medical_supplies/"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                </div>

            </div>
        </nav>
    </div>
</div><?php /**PATH /home/u881803686/domains/kaukamedics.medicalsean.org/public_html/resources/views/layouts/navbar.blade.php ENDPATH**/ ?>