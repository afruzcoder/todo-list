<x-guest-layout>
    <h1 class="mb-6 text-center text-xl font-semibold">Create an account</h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="form-control">
                <label class="label" for="name"><span class="label-text">{{ __('Name') }}</span></label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    autocomplete="given-name" class="input input-bordered w-full" />
                @error('name')
                    <span class="mt-1 text-sm text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control">
                <label class="label" for="surname"><span class="label-text">{{ __('Surname') }}</span></label>
                <input id="surname" type="text" name="surname" value="{{ old('surname') }}"
                    autocomplete="family-name" class="input input-bordered w-full" />
                @error('surname')
                    <span class="mt-1 text-sm text-error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-control">
            <label class="label" for="email"><span class="label-text">{{ __('Email') }}</span></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                autocomplete="username" class="input input-bordered w-full" />
            @error('email')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control">
            <label class="label" for="phone"><span class="label-text">{{ __('Phone') }}</span></label>
            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" autocomplete="tel"
                class="input input-bordered w-full" />
            @error('phone')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="form-control">
                <label class="label" for="password"><span class="label-text">{{ __('Password') }}</span></label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="input input-bordered w-full" />
                @error('password')
                    <span class="mt-1 text-sm text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control">
                <label class="label" for="password_confirmation"><span
                        class="label-text">{{ __('Confirm password') }}</span></label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" class="input input-bordered w-full" />
            </div>
        </div>

        <div class="flex items-center justify-end pt-2">
            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
        </div>

        <p class="pt-2 text-center text-sm opacity-70">
            {{ __('Already registered?') }}
            <a class="link link-primary" href="{{ route('login') }}">{{ __('Log in') }}</a>
        </p>
    </form>
</x-guest-layout>
