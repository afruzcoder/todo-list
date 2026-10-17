<x-guest-layout>
    <h1 class="mb-6 text-center text-xl font-semibold">Login</h1>

    @if (session('status'))
        <div class="alert alert-success mb-4 text-sm">
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div class="form-control">
            <label class="label" for="email"><span class="label-text">{{ __('Email') }}</span></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username" class="input input-bordered w-full" placeholder="you@example.com" />
            @error('email')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control">
            <label class="label" for="password"><span class="label-text">{{ __('Password') }}</span></label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="input input-bordered w-full" placeholder="••••••••" />
            @error('password')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <label class="label cursor-pointer justify-start gap-2">
            <input type="checkbox" name="remember" class="checkbox checkbox-sm checkbox-primary" />
            <span class="label-text">{{ __('Remember me') }}</span>
        </label>

        <div class="flex items-center justify-between pt-2">
            @if (Route::has('password.request'))
                <a class="link link-primary text-sm" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
        </div>

        <p class="pt-2 text-center text-sm opacity-70">
            {{ __("Don't have an account?") }}
            <a class="link link-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
        </p>
    </form>
</x-guest-layout>
