<section class="mb-5">
    <header class="mb-4">
        <h4 class="fw-bold text-primary mb-2">
            {{ __('Update Password') }}
        </h4>
        <p class="text-muted small mb-0">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="p-4 bg-light border rounded-4 shadow-sm">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="mb-3">
            <label for="update_password_current_password" class="form-label fw-semibold">
                {{ __('Current Password') }}
            </label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- New Password -->
        <div class="mb-3">
            <label for="update_password_password" class="form-label fw-semibold">
                {{ __('New Password') }}
            </label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-semibold">
                {{ __('Confirm Password') }}
            </label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Save Button -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-shield-lock-fill me-2"></i> {{ __('Save Password') }}
            </button>

            @if (session('status') === 'password-updated')
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
