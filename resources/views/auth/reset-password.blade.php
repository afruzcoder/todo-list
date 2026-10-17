<x-guest-layout>
    <h1 class="mb-6 text-center text-xl font-semibold">{{ __('Reset password') }}</h1>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-control">
            <label class="label" for="email"><span class="label-text">{{ __('Email') }}</span></label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required
                autofocus autocomplete="username" class="input input-bordered w-full" />
            @error('email')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

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
            @error('password_confirmation')
                <span class="mt-1 text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end pt-2">
            <button type="submit" class="btn btn-primary">{{ __('Reset password') }}</button>
        </div>
    </form>
</x-guest-layout>
