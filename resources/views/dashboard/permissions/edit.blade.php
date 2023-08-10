@seoTitle(__('main.permissions'))

<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-white rounded-lg">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-semibold">@lang('main.edit_permissions')</h1>
            </div>
            <x-splade-form :action="route('dashboard.permissions.update', $permission)" method="PUT" :default="$permission" class="space-y-4">
                <x-splade-input name="name" label="{{ __('main.name') }}" required />
                <x-splade-select name="roles[]" label="{{ __('main.roles') }}" :options="$roles" multiple relation choices />
                <x-splade-submit />
            </x-splade-form>
        </div>
    </div>
</x-dashboard-layout>
