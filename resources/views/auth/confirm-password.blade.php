<x-guest-layout>
    <h1 class="mb-2 text-center text-xl font-semibold">{{ __('Confirm password') }}</h1>

    <p class="mb-6 text-center text-sm opacity-60">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <div class="form-control">
            <label class="label" for="password"><span class="label-text">{{ __('Password') }}</span></label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="input input-bordered w-full" />
            @error('password')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end pt-2">
            <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button>
        </div>
    </form>
</x-guest-layout>
