@seoTitle(__('main.settings'))

<x-dashboard-layout>
    <x-section-content>
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">@lang('main.settings')</h1>
        </div>
        <div>
            <x-splade-form :action="route('dashboard.settings.update')" method="PUT" class="space-y-4"
                :default="
                    [
                        'website_name' => getSetting('website_name'),
                        'website_url' => getSetting('website_url'),
                        'website_email_address' => getSetting('website_email_address'),
                        'user_registration' => getSetting('user_registration'),
                        'new_user_default_role' => getSetting('new_user_default_role'),
                        'website_language' => getSetting('website_language'),
                        'timezone' => getSetting('timezone'),

                        {{-- SEO Configuration  --}}
                        'seo_title' => getSetting('seo_title'),
                        'seo_author' => getSetting('seo_author'),
                        'seo_keywords' => getSetting('seo_keywords'),
                        'seo_description' => getSetting('seo_description'),
                        'social_title' => getSetting('social_title'),
                        'social_description' => getSetting('social_description'),
                        'social_image' => social_image(),
                        'light_logo' => light_logo(),
                        'dark_logo' => dark_logo(),
                        'favicon' => favicon(),

                        // SMTP
                        'smtp_host' => getSetting('smtp_host'),
                        'smtp_port' => getSetting('smtp_port'),
                        'smtp_username' => getSetting('smtp_username'),
                        'smtp_password' => getSetting('smtp_password'),
                        'smtp_sender_email' => getSetting('smtp_sender_email'),
                        'smtp_sender_name' => getSetting('smtp_sender_name'),
                        'smtp_encryption' => getSetting('smtp_encryption'),

                        // Custom Code
                        'header_code' => getSetting('header_code'),
                        'footer_code' => getSetting('footer_code'),
                    ]
                ">
                {{-- Website Name --}}
                <x-splade-input v-model="form.website_name" name="website_name" :label="__('main.website_name')" required />
                {{-- Website URL --}}
                <x-splade-input v-model="form.website_url" type="url" name="website_url" :label="__('main.website_url')" required />
                {{-- Website Email Address --}}
                <x-splade-input v-model="form.website_email_address" name="website_email_address" :label="__('main.website_email_address')" required />
                {{-- User Registration --}}
                <x-splade-checkbox v-model="form.user_registration" name="user_registration" value="1" false-value="0"  label="{{ __('main.user_registration') }}" />
                {{-- New User Default Role --}}
                <x-splade-select v-model="form.new_user_default_role" name="new_user_default_role" :options="$roles" :label="__('main.new_user_default_role')" choices required />
                {{-- Website Language --}}
                <x-splade-select v-model="form.website_language" name="website_language" :options="$languages" :label="__('main.website_language')" choices required />

                {{-- Timezone --}}
                <x-splade-select v-model="form.timezone" name="timezone" :options="timezone_identifiers_list()" :label="__('main.timezone')" choices />
                {{-- Date format --}}
                <x-splade-select name="date_format" :label="__('main.date_format')" choices>
                    <option value="F j, Y" {{ getSetting('date_format') == 'F j, Y' ? 'selected' : ''  }}>{{ date("F j, Y") }}</option>
                    <option value="Y-m-d" {{ getSetting('date_format') == 'Y-m-d' ? 'selected' : ''  }}>{{ date("Y-m-d") }}</option>
                    <option value="m/d/Y" {{ getSetting('date_format') == 'm/d/Y' ? 'selected' : ''  }}>{{ date("m/d/Y") }}</option>
                    <option value="d/m/Y" {{ getSetting('date_format') == 'd/m/Y' ? 'selected' : ''  }}>{{ date("d/m/Y") }}</option>
                    <option value="Y/m/d" {{ getSetting('date_format') == 'Y/m/d' ? 'selected' : ''  }}>{{ date("Y/m/d") }}</option>                    
                </x-splade-select>
                {{-- Update Button --}}

                {{-- SEO Configuration  --}}
                <h2 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">@lang('main.seo_configuration')</h2>

                {{-- SEO Title --}}
                <x-splade-input v-model="form.seo_title" name="seo_title" :label="__('main.seo_title')" />
                {{-- SEO Author --}}
                <x-splade-input v-model="form.seo_author" name="seo_author" :label="__('main.seo_author')" />
                {{-- SEO Keywords --}}
                <x-splade-input v-model="form.seo_keywords" name="seo_keywords" :label="__('main.seo_keywords')" />
                {{-- SEO Description --}}
                <x-splade-input v-model="form.seo_description" name="seo_keywords" :label="__('main.seo_description')" />
                {{-- Social Title --}}
                <x-splade-input v-model="form.social_title" name="social_title" :label="__('main.social_title')" />
                {{-- Social Description --}}
                <x-splade-input v-model="form.social_description" name="social_description" :label="__('main.social_description')" />
                {{-- Social Image --}}
                <x-splade-file name="social_image" :label="__('main.social_image')" filepond preview accept="image/png,jpg,jpeg" max-size="5MB" />

                {{-- Logo & Favicon  --}}
                <h2 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">@lang('main.logo_and_favicon')</h2>

                {{-- Light Logo --}}
                <x-splade-file name="light_logo" :label="__('main.light_logo')" filepond preview accept="image/png,jpg,jpeg" max-size="5MB" />
                {{-- Dark Logo --}}
                <x-splade-file name="dark_logo" :label="__('main.dark_logo')" filepond preview accept="image/png,jpg,jpeg" max-size="5MB" />
                {{-- Favicon --}}
                <x-splade-file name="favicon" :label="__('main.favicon')" filepond preview accept="image/png,jpg,jpeg" max-size="5MB" :min-resolution="512 * 512" :max-resolution="512 * 512" />
                
                {{-- SMTP --}}
                <h2 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">@lang('main.smtp')</h2>

                {{-- SMTP Host --}}
                <x-splade-input v-model="form.smtp_host" name="smtp_host" :label="__('main.smtp_host')" />
                {{-- SMTP Port --}}
                <x-splade-input v-model="form.smtp_port" name="smtp_port" :label="__('main.smtp_port')" />
                {{-- SMTP Username --}}
                <x-splade-input v-model="form.smtp_username" name="smtp_username" :label="__('main.smtp_username')" />
                {{-- SMTP Password --}}
                <x-splade-input v-model="form.smtp_password" type="password" name="smtp_password" :label="__('main.smtp_password')" />
                {{-- SMTP Sender Email --}}
                <x-splade-input v-model="form.smtp_sender_email" name="smtp_sender_email" :label="__('main.smtp_sender_email')" />
                {{-- SMTP Sender Name --}}
                <x-splade-input v-model="form.smtp_sender_name" name="smtp_sender_name" :label="__('main.smtp_sender_name')" />
                {{-- SMTP Sender Encryption --}}
                <x-splade-input v-model="form.smtp_encryption" name="smtp_encryption" :label="__('main.smtp_encryption')" />

                {{-- Custom Code --}}
                <h2 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">@lang('main.custom_code')</h2>

                {{-- Header Code --}}
                <x-splade-textarea v-model="form.header_code" name="header_code" :label="__('main.header_code')" autosize />
                {{-- Footer Code --}}
                <x-splade-textarea v-model="form.footer_code" name="footer_code" :label="__('main.footer_code')" autosize />

                {{-- Update Button --}}
                <x-splade-submit :label="__('main.save')" />
            </x-splade-form>
        </div>
    </x-section-content>
</x-dashboard-layout>