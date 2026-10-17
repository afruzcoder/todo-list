<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-error">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm opacity-60">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button class="btn btn-error" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4 p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="text-sm opacity-60">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="form-control">
                <label class="label sr-only" for="password"><span class="label-text">{{ __('Password') }}</span></label>
                <input id="password" name="password" type="password" placeholder="{{ __('Password') }}"
                    class="input input-bordered w-full" />
                @if ($errors->userDeletion->get('password'))
                    <span class="mt-1 text-sm text-error">{{ $errors->userDeletion->first('password') }}</span>
                @endif
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" class="btn btn-ghost"
                    x-on:click="$dispatch('close')">{{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-error">{{ __('Delete Account') }}</button>
            </div>
        </form>
    </x-modal>
</section>
