<section class="mb-4">
    <div class="mb-3">
        <h5 class="mb-1">
            {{ __('Delete Account') }}
        </h5>
        <p class="text-muted mb-0">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </div>

    @if ($errors->userDeletion->isNotEmpty())
        <div class="alert alert-danger py-2 px-3">
            {{ __('There was a problem deleting your account. Please check the form below.') }}
        </div>
    @endif

    {{-- Trigger button --}}
    <button
        type="button"
        class="btn btn-danger btn-sm"
        data-toggle="modal"
        data-target="#confirm-delete-account-modal"
    >
        {{ __('Delete Account') }}
    </button>

    {{-- Bootstrap Modal --}}
    <div
        class="modal fade"
        id="confirm-delete-account-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="confirmDeleteAccountLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteAccountLabel">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p class="small text-muted">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="form-group mt-3">
                            <label for="delete_account_password">
                                {{ __('Password') }}
                            </label>
                            <input
                                id="delete_account_password"
                                name="password"
                                type="password"
                                class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif"
                                placeholder="{{ __('Password') }}"
                            >
                            @if ($errors->userDeletion->has('password'))
                                <small class="invalid-feedback">
                                    {{ $errors->userDeletion->first('password') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary btn-sm"
                            data-dismiss="modal"
                        >
                            {{ __('Cancel') }}
                        </button>
                        <button
                            type="submit"
                            class="btn btn-danger btn-sm"
                        >
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Kalau ada error di userDeletion, modal otomatis dibuka --}}
    @if ($errors->userDeletion->isNotEmpty())
        @push('scripts')
            <script>
                $(function () {
                    $('#confirm-delete-account-modal').modal('show');
                });
            </script>
        @endpush
    @endif
</section>
