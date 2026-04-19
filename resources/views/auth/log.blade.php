@include('layouts.head')
<body>
@include('layouts.topbar')
@include('layouts.navbar')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">{{ __('Welcome Back!') }}</h4>
                    <p class="mb-0 small">Login to continue to your account</p>
                </div>

                <div class="card-body p-4">
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required autofocus>

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                            <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                        </div>

                        <!-- Forgot Password + Submit -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none small">
                                    {{ __('Forgot Password?') }}
                                </a>
                            @endif

                            <button type="submit" class="btn btn-primary px-4">
                                {{ __('Log in') }}
                            </button>
                        </div>

                        <!--<div class="text-center">
                            <p class="mb-0">Don’t have an account?
                                <a href="{{ route('register') }}" class="text-primary text-decoration-none">
                                    {{ __('Register here') }}
                                </a>
                            </p>
                        </div>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@include('layouts.links')
</body>
</html>
