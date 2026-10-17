<x-guest-layout>
    <h1 class="mb-2 text-center text-xl font-semibold">{{ __('Forgot your password?') }}</h1>

    <p class="mb-6 text-center text-sm opacity-60">
        {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </p>

    @if (session('status'))
        <div class="alert alert-success mb-4 text-sm">
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div class="form-control">
            <label class="label" for="email"><span class="label-text">{{ __('Email') }}</span></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="input input-bordered w-full" />
            @error('email')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <a class="link link-primary text-sm" href="{{ route('login') }}">{{ __('Back to login') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('Email reset link') }}</button>
        </div>
    </form>
</x-guest-layout>
