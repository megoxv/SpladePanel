@seoTitle(__('main.add_plugin'))

<x-dashboard-layout>
    {{-- Head --}}
    <div class="flex justify-between items-end mb-4">
        <div>
            <nav class="fi-breadcrumbs mb-2 hidden sm:block">
                <ul class="flex flex-wrap items-center gap-x-2">
                    <li class="flex gap-x-2">
                        <Link href="{{ route('dashboard.plugins.index') }}"
                            class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            @lang('main.plugins')
                        </Link>
                    </li>
                    <li class="flex items-center gap-x-2">
                        <i class="fa-solid fa-chevron-right text-gray-400 dark:text-gray-500 text-xs rtl:rotate-180"></i>
                        <a href="#" class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            @lang('main.add_plugin')
                        </a>
                    </li>
                </ul>
            </nav>
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                @lang('main.add_plugin')
            </h1>
        </div>
        <div>
        </div>
    </div>
    <x-section-content>
            <x-splade-form :action="route('dashboard.plugins.store')" method="POST" class="space-y-4">
                <p class="dark:text-gray-300">@lang('main.if_you_have_a_plugin_in_a_.zip_format,_you_may_install_or_update_it_by_uploading_it_here')</p>
                <x-splade-file name="file" filepond server />
                <x-splade-submit :label="__('main.install_now')" />
            </x-splade-form>
    </x-section-content>
</x-dashboard-layout>