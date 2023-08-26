@seoTitle(__('main.register'))

<x-authentication-card>
    <h1 class="text-center text-2xl font-bold tracking-tight text-gray-950 dark:text-white mb-6">@lang('main.register')</h1>
    <x-splade-form class="space-y-4">
        <x-splade-input id="name" name="name" :label="__('main.name')" required autofocus />
        <x-splade-input id="username" name="username" :label="__('main.username')" required />
        <x-splade-input id="email" name="email" type="email" :label="__('main.email')" required />
        <x-splade-input id="password" name="password" type="password" :label="__('main.password')" required autocomplete="new-password" />
        <x-splade-input id="password_confirmation" name="password_confirmation" type="password" :label="__('main.confirm_password')" required autocomplete="new-password" />

        @if(\Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <x-splade-checkbox name="terms">
                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('main.terms_of_service').'</a>',
                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('main.privacy_policy').'</a>',
                ]) !!}
            </x-splade-checkbox>
        @endif

        <x-splade-submit :label="__('main.register')" class="w-full" />
        <Link href="{{ route('login') }}" class="inline-block underline text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('main.already_registered?') }}
        </Link>   
    </x-splade-form>
</x-authentication-card>
