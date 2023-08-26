@seoTitle(__('main.reset_password'))

<x-authentication-card>
    <h1 class="text-center text-2xl font-bold tracking-tight text-gray-950 dark:text-white mb-6">@lang('main.reset_password')</h1>
    <x-splade-form class="space-y-4" :action="route('password.update')" :default="['email' => request()->input('email'), 'token' => request()->route('token')]">
        <x-splade-input id="email" name="email" type="email" :label="__('main.email')" required autofocus />
        <x-splade-input id="password" name="password" type="password" :label="__('main.password')" required autocomplete="new-password" />
        <x-splade-input id="password_confirmation" name="password_confirmation" type="password" :label="__('main.confirm_password')" required autocomplete="new-password" />
        <x-splade-submit :label="__('main.reset_password')" class="w-full" />
    </x-splade-form>
</x-authentication-card>
