<?php echo $__env->make('layouts.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<body>
<?php echo $__env->make('layouts.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0"><?php echo e(__('Welcome Back!')); ?></h4>
                    <p class="mb-0 small">Login to continue to your account</p>
                </div>

                <div class="card-body p-4">
                    <!-- Session Status -->
                    <?php if(session('status')): ?>
                        <div class="alert alert-success"><?php echo e(session('status')); ?></div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label"><?php echo e(__('Email Address')); ?></label>
                            <input id="email" type="email" name="email"
                                class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('email')); ?>" required autofocus>

                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label"><?php echo e(__('Password')); ?></label>
                            <input id="password" type="password" name="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>

                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                            <label class="form-check-label" for="remember_me"><?php echo e(__('Remember me')); ?></label>
                        </div>

                        <!-- Forgot Password + Submit -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <?php if(Route::has('password.request')): ?>
                                <a href="<?php echo e(route('password.request')); ?>" class="text-decoration-none small">
                                    <?php echo e(__('Forgot Password?')); ?>

                                </a>
                            <?php endif; ?>

                            <button type="submit" class="btn btn-primary px-4">
                                <?php echo e(__('Log in')); ?>

                            </button>
                        </div>

                        <!--<div class="text-center">
                            <p class="mb-0">Don’t have an account?
                                <a href="<?php echo e(route('register')); ?>" class="text-primary text-decoration-none">
                                    <?php echo e(__('Register here')); ?>

                                </a>
                            </p>
                        </div>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('layouts.links', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH /home/u881803686/domains/kaukamedics.medicalsean.org/public_html/resources/views/auth/login.blade.php ENDPATH**/ ?>