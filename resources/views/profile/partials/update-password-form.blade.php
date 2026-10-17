<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm opacity-60">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div class="form-control">
            <label class="label" for="update_password_current_password"><span
                    class="label-text">{{ __('Current Password') }}</span></label>
            <input id="update_password_current_password" name="current_password" type="password"
                autocomplete="current-password" class="input input-bordered w-full" />
            @if ($errors->updatePassword->get('current_password'))
                <span class="mt-1 text-sm text-error">{{ $errors->updatePassword->first('current_password') }}</span>
            @endif
        </div>

        <div class="form-control">
            <label class="label" for="update_password_password"><span
                    class="label-text">{{ __('New Password') }}</span></label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="input input-bordered w-full" />
            @if ($errors->updatePassword->get('password'))
                <span class="mt-1 text-sm text-error">{{ $errors->updatePassword->first('password') }}</span>
            @endif
        </div>

        <div class="form-control">
            <label class="label" for="update_password_password_confirmation"><span
                    class="label-text">{{ __('Confirm Password') }}</span></label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                autocomplete="new-password" class="input input-bordered w-full" />
            @if ($errors->updatePassword->get('password_confirmation'))
                <span class="mt-1 text-sm text-error">{{ $errors->updatePassword->first('password_confirmation') }}</span>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm opacity-60">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
