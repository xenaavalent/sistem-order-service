<section class="mb-4">
    <div class="mb-3">
        <h5 class="mb-1">
            {{ __('Update Password') }}
        </h5>
        <p class="text-muted mb-0">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </div>

    @if (session('status') === 'password-updated')
        <div class="alert alert-success py-2 px-3">
            {{ __('Your password has been updated.') }}
        </div>
    @endif

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div class="form-group">
            <label for="update_password_current_password">
                {{ __('Current Password') }}
            </label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif"
                autocomplete="current-password"
            >
            @if ($errors->updatePassword->has('current_password'))
                <small class="invalid-feedback">
                    {{ $errors->updatePassword->first('current_password') }}
                </small>
            @endif
        </div>

        {{-- New Password --}}
        <div class="form-group">
            <label for="update_password_password">
                {{ __('New Password') }}
            </label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif"
                autocomplete="new-password"
            >
            @if ($errors->updatePassword->has('password'))
                <small class="invalid-feedback">
                    {{ $errors->updatePassword->first('password') }}
                </small>
            @endif
        </div>

        {{-- Confirm Password --}}
        <div class="form-group">
            <label for="update_password_password_confirmation">
                {{ __('Confirm Password') }}
            </label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-control @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif"
                autocomplete="new-password"
            >
            @if ($errors->updatePassword->has('password_confirmation'))
                <small class="invalid-feedback">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary btn-sm">
            {{ __('Save') }}
        </button>
    </form>
</section>
