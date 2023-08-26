@seoTitle(__('main.roles'))

<x-dashboard-layout>
    {{-- Head --}}
    <div class="flex justify-between items-end mb-4">
        <div>
            <nav class="fi-breadcrumbs mb-2 hidden sm:block">
                <ul class="flex flex-wrap items-center gap-x-2">
                    <li class="flex gap-x-2">
                        <Link href="{{ route('dashboard.roles.index') }}"
                            class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            @lang('main.roles')
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
                @lang('main.roles')
            </h1>
        </div>
        <div>
            @can('create roles')
                <x-btn-link href="#create">
                    @lang('main.add_new')
                </x-btn-link>
            @endcan
        </div>
    </div>
    {{-- Create Modal --}}
    @can('create roles')
        <x-splade-modal name="create">
            <x-splade-form :action="route('dashboard.roles.store')" method="POST" class="space-y-4">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    @lang('main.add_new')
                </h3>
                <x-splade-input name="name" label="{{ __('main.name') }}" required />
                <x-splade-select name="permissions[]" label="{{ __('main.permissions') }}" :options="$permissions" multiple relation choices required />
                <x-splade-submit :label="__('main.submit')" />
            </x-splade-form>
        </x-splade-modal>
    @endcan
    {{-- Content --}}
    <x-section-content>
        <x-splade-table :for="$roles">
            <x-splade-cell action as="$role">
                {{-- Edit --}}
                @can('update roles')
                    <x-nav-link href="{{ route('dashboard.roles.edit', $role) }}"> 
                        @lang('main.edit')
                    </x-nav-link>
                @endcan
                {{-- Delete --}}
                @can('delete roles')
                    <x-nav-link href="{{ route('dashboard.roles.destroy', $role) }}" method="DELETE" confirm="{{ __('main.confirm_delete_role') }}" confirm-text="{{ __('main.confirm_text_delete_role') }}" class="text-red-600 dark:text-red-600"> 
                        @lang('main.delete')
                    </x-nav-link>
                @endcan
            </x-splade-cell>
        </x-splade-table>
    </x-section-content>
</x-dashboard-layout>