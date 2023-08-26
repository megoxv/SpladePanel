@seoTitle(__('Email Verification'))

<x-authentication-card>
    <x-splade-form :action="route('verification.send')" stay prevent-scroll>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-300">
            {{ __('main.verify_email_message') }}
        </div>

        <div v-if="form.wasSuccessful" class="mb-4 font-medium text-sm text-green-600">
            {{ __('main.verify_email_message_successful') }}
        </div>

        <div class="mt-4 flex items-center justify-between">
            <x-splade-submit :label="__('main.resend_verification_email')" />

            <div>
                <Link
                    href="{{ route('profile.show') }}"
                    class="underline text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >{{ __('main.edit_profile') }}</Link>

                <Link
                    href="{{ route('logout') }}"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ltr:ml-2 rtl:mr-2"
                >{{ __('main.logout') }}</Link>
            </div>
        </div>
    </x-splade-form>
</x-authentication-card>
