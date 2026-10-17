<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm opacity-60">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div class="form-control">
            <label class="label" for="name"><span class="label-text">{{ __('Name') }}</span></label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
                autocomplete="name" class="input input-bordered w-full" />
            @error('name')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control">
            <label class="label" for="surname"><span class="label-text">{{ __('Surname') }}</span></label>
            <input id="surname" name="surname" type="text" value="{{ old('surname', $user->surname) }}"
                autocomplete="family-name" class="input input-bordered w-full" />
            @error('surname')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control">
            <label class="label" for="phone"><span class="label-text">{{ __('Phone') }}</span></label>
            <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}"
                autocomplete="tel" class="input input-bordered w-full" />
            @error('phone')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control">
            <label class="label" for="email"><span class="label-text">{{ __('Email') }}</span></label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                autocomplete="username" class="input input-bordered w-full" />
            @error('email')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="link link-primary text-sm">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm opacity-60">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
