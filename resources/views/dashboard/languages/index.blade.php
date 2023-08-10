@seoTitle(__('main.languages'))

<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-white rounded-lg">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-semibold">@lang('main.languages')</h1>
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
                        <h3 class="text-xl font-medium text-gray-900">
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
                        <x-splade-submit />
                    </x-splade-form>
                </x-splade-modal>
            @endcan

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
                            <h3 class="text-xl font-medium text-gray-900">
                                @lang('main.edit_language')
                            </h3>
                            <x-splade-input v-model="form.name" name="name" label="{{ __('main.name') }}" required />
                            <x-splade-input v-model="form.code" name="code" label="{{ __('main.language_code') }}" disabled />
                            <x-splade-select v-model="form.dir" name="dir" label="{{ __('main.direction') }}" required>
                                <option value="ltr">@lang('main.ltr')</option>
                                <option value="rtl">@lang('main.rtl')</option>
                            </x-splade-select>

                            <x-splade-select name="icon" :options="countries_list()" label="{{ __('main.country_code') }}" choices required />

                            <x-splade-select v-model="form.status" name="status" label="{{ __('main.status') }}" >
                                <option value="Active">@lang('main.active')</option>
                                <option value="Disabled">@lang('main.disabled')</option>
                            </x-splade-select>
                            <x-splade-submit />
                        </x-splade-form>
                    </x-splade-modal>

                    {{-- Delete --}}
                    @if ($language->code != getSetting('website_language'))
                        @can('delete languages')
                            <x-nav-link href="{{ route('dashboard.languages.destroy', $language) }}" method="DELETE" confirm="{{ __('main.confirm_delete_language') }}" confirm-text="{{ __('main.confirm_text_delete_language') }}" class="text-red-600"> 
                                @lang('main.delete')
                            </x-nav-link>
                        @endcan
                    @endif
                </x-splade-cell>         
            </x-splade-table>
        </div>
    </div>
</x-dashboard-layout>
