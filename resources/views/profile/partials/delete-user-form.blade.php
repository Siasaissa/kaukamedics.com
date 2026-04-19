<section class="mb-5">
    <header class="mb-4">
        <h4 class="fw-bold text-danger mb-2">
            {{ __('Delete Account') }}
        </h4>
        <p class="text-muted small mb-0">
            {{ __('Once your account is deleted, all of its resources and data will be permanently removed. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Delete Button -->
    <button type="button"
        class="btn btn-outline-danger px-4"
        data-bs-toggle="modal"
        data-bs-target="#confirmUserDeletionModal">
        <i class="bi bi-trash3-fill me-2"></i> {{ __('Delete Account') }}
    </button>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-danger text-white rounded-top-4">
                    <h5 class="modal-title fw-semibold" id="confirmUserDeletionModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ __('Confirm Account Deletion') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="post" action="{{ route('profile.destroy') }}" class="modal-body p-4">
                    @csrf
                    @method('delete')

                    <p class="text-muted small mb-3">
                        {{ __('This action is irreversible. Once your account is deleted, all your data and resources will be permanently removed. Please enter your password to confirm.') }}
                    </p>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="delete_password" class="form-label fw-semibold">{{ __('Password') }}</label>
                        <input
                            id="delete_password"
                            name="password"
                            type="password"
                            class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                            placeholder="{{ __('Enter your password to confirm') }}">
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Modal Actions -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> {{ __('Cancel') }}
                        </button>

                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash3-fill me-1"></i> {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
