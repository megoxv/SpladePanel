@seoTitle(__('main.permissions'))

<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-white rounded-lg">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-semibold">@lang('main.permissions')</h1>
                <div>
                    @can('create permissions')
                        <x-btn-link href="#create">
                            @lang('main.add_new')
                        </x-btn-link>
                    @endcan
                </div>
            </div>
            {{-- Create Modal --}}
            @can('create permissions')
                <x-splade-modal name="create">
                    <x-splade-form :action="route('dashboard.permissions.store')" method="POST" class="space-y-4">
                        <h3 class="text-xl font-medium text-gray-900">
                            @lang('main.add_new')
                        </h3>
                        <x-splade-input name="name" label="{{ __('main.name') }}" required />
                        <x-splade-select name="roles[]" label="{{ __('main.roles') }}" :options="$roles" multiple relation choices />
                        <x-splade-submit />
                    </x-splade-form>
                </x-splade-modal>
            @endcan

            <x-splade-table :for="$permissions">
                <x-splade-cell action as="$permission">
                    {{-- Edit --}}
                    @can('update permissions')
                        <x-nav-link href="{{ route('dashboard.permissions.edit', $permission) }}"> 
                            @lang('main.edit')
                        </x-nav-link>
                    @endcan
                    {{-- Delete --}}
                    @can('delete permissions')
                        <x-nav-link href="{{ route('dashboard.permissions.destroy', $permission) }}" method="DELETE" confirm="{{ __('main.confirm_delete_permission') }}" confirm-text="{{ __('main.confirm_text_delete_permission') }}" class="text-red-600"> 
                            @lang('main.delete')
                        </x-nav-link>
                    @endcan
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-dashboard-layout>
