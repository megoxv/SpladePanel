@seoTitle(__('main.add_plugin'))

<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-white rounded-lg">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-semibold">@lang('main.add_plugin')</h1>
            </div>
            <x-splade-form :action="route('dashboard.plugins.store')" method="POST" class="space-y-4">
                <p>@lang('main.if_you_have_a_plugin_in_a_.zip_format,_you_may_install_or_update_it_by_uploading_it_here')</p>
                <x-splade-file name="file" filepond server />
                <x-splade-submit :label="__('main.install_now')" />
            </x-splade-form>
        </div>
    </div>
</x-dashboard-layout>