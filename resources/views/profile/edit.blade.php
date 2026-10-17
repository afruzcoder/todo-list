<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold">{{ __('Profile') }}</h1>
    </x-slot>

    <div class="mx-auto max-w-2xl space-y-6">
        <div class="rounded-box bg-base-100 p-6 shadow">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="rounded-box bg-base-100 p-6 shadow">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="rounded-box bg-base-100 p-6 shadow">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
