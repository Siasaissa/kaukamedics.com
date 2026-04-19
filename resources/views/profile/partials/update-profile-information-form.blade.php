<section class="mb-5">
    <header class="mb-4">
        <h4 class="fw-bold text-primary mb-2">
            {{ __('Profile Information') }}
        </h4>
        <p class="text-muted small mb-0">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <!-- Email Verification Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Update Profile Form -->
    <form method="post" action="{{ route('profile.update') }}" class="p-4 bg-light border rounded-4 shadow-sm">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">{{ __('Full Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
            <input
                id="email"
                name="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-3 p-2 small" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="btn btn-link btn-sm text-primary text-decoration-none">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success mt-2 small">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-save me-2"></i> {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small m-0">
                    <i class="bi bi-check-circle me-1"></i> {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
