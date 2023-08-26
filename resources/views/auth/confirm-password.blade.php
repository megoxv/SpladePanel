@seoTitle(__('main.secure_area'))

<x-authentication-card>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-300">
        {{ __('main.confirm_password_message') }}
    </div>

    <x-splade-form class="space-y-4" :action="route('password.confirm')">
        <x-splade-input id="password" name="password" type="password" :label="__('main.password')" required autocomplete="current-password" autofocus />

        <x-splade-submit :label="__('main.confirm')" class="w-full" />
    </x-splade-form>
</x-authentication-card>
