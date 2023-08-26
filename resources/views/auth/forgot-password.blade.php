@seoTitle(__('main.forgot_password'))

<x-authentication-card>
    <h1 class="text-center text-2xl font-bold tracking-tight text-gray-950 dark:text-white mb-6">@lang('main.forgot_password')</h1>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-300">
        {{ __('main.forgot_password_message') }}
    </div>

    @if($status = session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $status }}
        </div>
    @endif

    <x-splade-form class="space-y-4" :action="route('password.email')">
        <x-splade-input id="email" name="email" type="email" :label="__('main.email')" required autofocus />
        <x-splade-submit :label="__('main.email_password_reset_link')" class="w-full" />
    </x-splade-form>
</x-authentication-card>
