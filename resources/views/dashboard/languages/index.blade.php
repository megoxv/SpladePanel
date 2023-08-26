@seoTitle(__('main.languages'))

<x-dashboard-layout>
    {{-- Head --}}
    <div class="flex justify-between items-end mb-4">
        <div>
            <nav class="fi-breadcrumbs mb-2 hidden sm:block">
                <ul class="flex flex-wrap items-center gap-x-2">
                    <li class="flex gap-x-2">
                        <Link href="{{ route('dashboard.languages.index') }}"
                            class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            @lang('main.languages')
                        </Link>
                    </li>
                    <li class="flex items-center gap-x-2">
                        <i class="fa-solid fa-chevron-right text-gray-400 dark:text-gray-500 text-xs rtl:rotate-180"></i>
                        <a href="#" class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            @lang('main.list')
                        </a>
                    </li>
                </ul>
            </nav>
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                @lang('main.languages')
            </h1>
        </div>
        <div>
            @can('create languages')
                <x-btn-link href="#create">
                    @lang('main.add_new')
                </x-btn-link>
            @endcan
        </div>
    </div>
    {{-- Create Modal --}}
    @can('create languages')
        <x-splade-modal name="create">
            <x-splade-form :action="route('dashboard.languages.store')" method="POST" class="space-y-4">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    @lang('main.add_new')
                </h3>
                <x-splade-input name="name" label="{{ __('main.name') }}" required />
                <x-splade-input name="code" label="{{ __('main.language_code') }}" required />
                <x-splade-select name="dir" label="{{ __('main.direction') }}" required>
                    <option value="ltr">@lang('main.ltr')</option>
                    <option value="rtl">@lang('main.rtl')</option>
                </x-splade-select>
                <x-splade-select name="icon" :options="countries_list()" label="{{ __('main.country_code') }}" choices required />
                <x-splade-select name="status" label="{{ __('main.status') }}" required>
                    <option value="Active">@lang('main.active')</option>
                    <option value="Disabled">@lang('main.disabled')</option>
                </x-splade-select>
                <x-splade-submit :label="__('main.submit')" />
            </x-splade-form>
        </x-splade-modal>
    @endcan
    {{-- Content --}}
    <x-section-content>
        <x-splade-table :for="$languages">
            <x-splade-cell icon>
                <img src="{{ asset("assets/flags/$item->icon.svg") }}" alt="{{ $item->icon }}" width="25">
            </x-splade-cell>
            <x-splade-cell action as="$language">
                {{-- Update Translations --}}
                @can('update languages')
                    <x-nav-link away href="{{ route('translations_ui.index') }}">
                        @lang('main.translations')
                    </x-nav-link>
                @endcan

                {{-- Edit --}}
                @can('update languages')
                    <x-nav-link href="#edit-{{ $language->id }}">
                        @lang('main.edit')
                    </x-nav-link>
                @endcan

                <x-splade-modal name="edit-{{ $language->id }}">
                    <x-splade-form :default="$language" :action="route('dashboard.languages.update', $language)" method="PUT" class="space-y-4">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            @lang('main.edit_language')
                        </h3>
                        <x-splade-input v-model="form.name" name="name" label="{{ __('main.name') }}"
                            required />
                        <x-splade-input v-model="form.code" name="code" label="{{ __('main.language_code') }}"
                            disabled />
                        <x-splade-select v-model="form.dir" name="dir" label="{{ __('main.direction') }}"
                            required>
                            <option value="ltr">@lang('main.ltr')</option>
                            <option value="rtl">@lang('main.rtl')</option>
                        </x-splade-select>

                        <x-splade-select name="icon" :options="countries_list()" label="{{ __('main.country_code') }}"
                            choices required />

                        <x-splade-select v-model="form.status" name="status" label="{{ __('main.status') }}">
                            <option value="Active">@lang('main.active')</option>
                            <option value="Disabled">@lang('main.disabled')</option>
                        </x-splade-select>
                        <x-splade-submit>@lang('main.submit')</x-splade-submit>
                    </x-splade-form>
                </x-splade-modal>

                {{-- Delete --}}
                @if ($language->code != getSetting('website_language'))
                    @can('delete languages')
                        <x-nav-link href="{{ route('dashboard.languages.destroy', $language) }}" method="DELETE"
                            confirm="{{ __('main.confirm_delete_language') }}"
                            confirm-text="{{ __('main.confirm_text_delete_language') }}" class="text-red-600 dark:text-red-600">
                            @lang('main.delete')
                        </x-nav-link>
                    @endcan
                @endif
            </x-splade-cell>
        </x-splade-table>
    </x-section-content>
</x-dashboard-layout>
