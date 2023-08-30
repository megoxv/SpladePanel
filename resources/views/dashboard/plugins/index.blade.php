@seoTitle(__('main.plugins'))

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
                            @lang('main.list')
                        </a>
                    </li>
                </ul>
            </nav>
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                @lang('main.plugins')
            </h1>
        </div>
        <div>
            @can('create plugins')
                <x-btn-link href="{{ route('dashboard.plugins.create') }}">
                    @lang('main.add_plugin')
                </x-btn-link>
            @endcan
        </div>
    </div>
    {{-- Content --}}
    <x-section-content>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @php
                $plugins = Module::all();
            @endphp

            @forelse ($plugins as $plugin)
                <div class="bg-gray-100 dark:bg-gray-900/50 p-4 rounded-lg">
                    <div class="flex">
                        <div class="h-32 min-w-[8rem] min-h-full p-4 flex items-center justify-center rounded-2xl ltr:mr-3 rtl:ml-3"
                            style="background-color: {{ $plugin->get('color') }}">
                            <i class="{{ $plugin->get('icon') }} text-5xl text-white"></i>
                        </div>
                        <div>
                            <div class="flex justify-between mb-2">
                                <h6 class="text-xl font-bold dark:text-white">{{ $plugin->get('title') }}</h6>
                                <div class="flex items-center">
                                    @can('update plugins')
                                        @if ($plugin->isEnabled())
                                            <x-nav-link href="{{ route('dashboard.plugins.deactivate', ['plugin' => $plugin->get('name')]) }}" method="POST"> 
                                                @lang('main.deactivate')
                                            </x-nav-link>
                                        @else
                                            <x-nav-link href="{{ route('dashboard.plugins.activate', ['plugin' => $plugin->get('name')]) }}" method="POST"> 
                                                @lang('main.activate')
                                            </x-nav-link>
                                        @endif
                                    @endcan
                                    @can('delete plugins')
                                        <span class="mx-1 text-gray-400">|</span>
                                        <x-nav-link href="{{ route('dashboard.plugins.delete', ['plugin' => $plugin->get('name')]) }}" method="POST" confirm="{{ __('main.confirm_delete_plugin') }}" confirm-text="{{ __('main.confirm_text_delete_plugin') }}" class="text-red-600 dark:text-red-600"> 
                                            @lang('main.delete')
                                        </x-nav-link>
                                    @endcan
                                </div>
                            </div>
                            <p class="text-sm dark:text-gray-300">{{ $plugin->get('description') }}</p>
                            <p class="text-sm mt-2 dark:text-gray-300">
                                <span>@lang('main.by') <strong class="dark:text-white">{{ $plugin->get('author') }}</strong></span> <span class="dark:text-white">&#x2022; @lang('main.version'){{ $plugin->get('version') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div>
                    <h6 class="text-gray-600 dark:text-gray-300">@lang('main.there_are_no_plugins')</h6>
                </div>
            @endforelse
        </div>
    </x-section-content>
</x-dashboard-layout>
