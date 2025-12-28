<section class="mb-4">
    <div class="mb-3">
        <h5 class="mb-1">
            {{ __('Profile Information') }}
        </h5>
        <p class="text-muted mb-0">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </div>

    {{-- Form kirim ulang verifikasi email --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Notifikasi profil berhasil diupdate --}}
    @if (session('status') === 'profile-updated')
        <div class="alert alert-success py-2 px-3">
            {{ __('Your profile has been updated.') }}
        </div>
    @endif

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}"
                required
                autocomplete="name"
            >
            @error('name')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input
                id="email"
                name="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            >
            @error('email')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="small mb-1">
                        {{ __('Your email address is unverified.') }}
                    </p>

                    <button
                        form="send-verification"
                        type="submit"
                        class="btn btn-link btn-sm p-0 align-baseline"
                    >
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="small text-success mb-0 mt-1">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary btn-sm">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</section>
