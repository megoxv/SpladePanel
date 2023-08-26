@seoTitle(__('main.two_factor_confirmation'))

<x-authentication-card>
    <x-splade-data default="{ recovery: false }">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-300">
            <p v-if="!data.recovery">
                {{ __('main.two_factor_recovery_message') }}
            </p>

            <p v-else>
                {{ __('main.two_factor_recovery_message_else') }}
            </p>
        </div>

        <x-splade-form :action="route('two-factor.login')">
            <div v-if="!data.recovery">
                <x-splade-input name="code" inputmode="numeric" autofocus autocomplete="one-time-code" :label="__('main.code')" />
            </div>

            <div v-if="data.recovery">
                <x-splade-input name="recovery_code" autocomplete="one-time-code" autofocus :label="__('main.recovery_code')" />
            </div>

            <div class="flex items-center justify-end mt-4 space-x-4">
                <button type="button" class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-400 underline cursor-pointer" @click.prevent="data.recovery = !data.recovery">
                    <span v-show="data.recovery">
                        {{ __('Use a recovery code') }}
                    </span>

                    <span v-show="!data.recovery">
                        {{ __('main.use_an_authentication_code') }}
                    </span>
                </button>

                <x-splade-submit :label="__('main.login')" />
            </div>
        </x-splade-form>
    </x-splade-data>
</x-authentication-card>
