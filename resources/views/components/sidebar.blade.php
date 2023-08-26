
<aside :class="{'translate-x-0': sidebar.open, 'ltr:-translate-x-full rtl:translate-x-full': ! sidebar.open}" {{ $attributes->class(['fixed inset-y-0 ltr:left-0 rtl:right-0 z-50 w-64 flex-wrap items-center justify-between block p-0 my-4 overflow-y-auto transition-all duration-200 ease-in-out  bg-white border-0 shadow-none ltr:xl:ml-6 rtl:xl:mr-6 dark:bg-gray-800 z-990 max-w-64 rounded-2xl ltr:xl:translate-x-0 rtl:xl:translate-x-0']) }}>
    <div class="h-20">
        <i class="fas fa-times absolute top-0 ltr:right-0 rtl:left-0 p-4 opacity-50 cursor-pointer text-gray-400 dark:text-white xl:hidden" @click="sidebar.open = ! sidebar.open"></i>
        <Link href="{{ route('dashboard.index') }}" class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-gray-700 dark:text-white">
            <x-application-logo class="block h-9 w-auto" />
        </Link>
    </div>

    <div class="items-center block w-full h-auto grow basis-full" id="sidenav-collapse-main">
        <nav class="space-y-3">
            {{-- Home Dashboard --}}
            <Link href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'bg-indigo-50 dark:bg-indigo-400 text-gray-700 dark:text-white font-semibold' : '' }} text-sm py-3 my-0 mx-2 flex items-center whitespace-nowrap px-4 font-medium text-gray-500 dark:text-white hover:bg-indigo-50 dark:hover:bg-indigo-400 rounded-lg shadow-none transition-colors ease-in-out">
                <i class="fa-solid fa-house"></i>
                <span class="mx-2 text-sm">@lang('main.home')</span>
            </Link>

            {{-- Plugins --}}
            @php
                $plugins = Module::allEnabled();
            @endphp

            @foreach($plugins as $plugin)
                @can( 'read ' . $plugin->get('alias'))
                    <Link href="{{ route('dashboard.' . $plugin->get('alias') . '.index') }}" class="{{ request()->routeIs('dashboard.' . $plugin->get('alias') . '.index') ? 'bg-indigo-50 dark:bg-indigo-400 text-gray-700 dark:text-white font-semibold' : '' }} text-sm py-3 my-0 mx-2 flex items-center whitespace-nowrap px-4 font-medium text-gray-500 dark:text-white hover:bg-indigo-50 dark:hover:bg-indigo-400 rounded-lg shadow-none transition-colors ease-in-out">
                            <i class="{{ $plugin->get('icon') }}"></i>
                        <span class="mx-2 text-sm">{{$plugin->get('name')}}</span>
                    </Link>
                @endcan
            @endforeach

            {{-- Reports --}}
            @can('read reports')
                <x-splade-dropdown class="w-full">
                    <x-slot:trigger>
                        <a class="text-sm py-3 my-0 mx-2 flex items-center whitespace-nowrap px-4 font-medium text-gray-500 dark:text-white hover:bg-indigo-50 dark:hover:bg-indigo-400 rounded-lg shadow-none transition-colors ease-in-out" href="#">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span class="mx-2 text-sm">@lang('main.reports')</span>
                        </a>
                    </x-slot>
                    <div class="w-48 mt-2 p-1 divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10">
                        <x-dropdown-link :href="route('dashboard.traffics.index')">
                            @lang('main.traffics')
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('dashboard.traffics.logs')">
                            @lang('main.traffics_logs')
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('dashboard.traffics.error-reports')">
                            @lang('main.error_reports')
                        </x-dropdown-link>
                    </div>
                </x-splade-dropdown>
            @endcan

            {{-- Languages --}}
            @can('read languages')
                <Link href="{{ route('dashboard.languages.index') }}" class="{{ request()->routeIs('dashboard.languages.index') ? 'bg-indigo-50 dark:bg-indigo-400 text-gray-700 dark:text-white font-semibold' : '' }} text-sm py-3 my-0 mx-2 flex items-center whitespace-nowrap px-4 font-medium text-gray-500 dark:text-white hover:bg-indigo-50 dark:hover:bg-indigo-400 rounded-lg shadow-none transition-colors ease-in-out">
                    <i class="fa-solid fa-language"></i>
                    <span class="mx-2 text-sm">@lang('main.languages')</span>
                </Link>
            @endcan

            {{-- Permissions --}}
            @can('read permissions')
                <Link href="{{ route('dashboard.permissions.index') }}" class="{{ request()->routeIs('dashboard.permissions.index') ? 'bg-indigo-50 dark:bg-indigo-400 text-gray-700 dark:text-white font-semibold' : '' }} text-sm py-3 my-0 mx-2 flex items-center whitespace-nowrap px-4 font-medium text-gray-500 dark:text-white hover:bg-indigo-50 dark:hover:bg-indigo-400 rounded-lg shadow-none transition-colors ease-in-out">
                    <i class="fa-solid fa-fingerprint"></i>
                    <span class="mx-2 text-sm font-medium">@lang('main.permissions')</span>
                </Link>
            @endcan

            {{-- Roles --}}
            @can('read roles')
                <Link href="{{ route('dashboard.roles.index') }}" class="{{ request()->routeIs('dashboard.roles.index') ? 'bg-indigo-50 dark:bg-indigo-400 text-gray-700 dark:text-white font-semibold' : '' }} text-sm py-3 my-0 mx-2 flex items-center whitespace-nowrap px-4 font-medium text-gray-500 dark:text-white hover:bg-indigo-50 dark:hover:bg-indigo-400 rounded-lg shadow-none transition-colors ease-in-out">
                    <i class="fa-solid fa-key"></i>
                    <span class="mx-2 text-sm font-medium">@lang('main.roles')</span>
                </Link>
            @endcan

            {{-- Users --}}
            @can('read users')
                <Link href="{{ route('dashboard.user.index') }}" class="{{ request()->routeIs('dashboard.user.index') ? 'bg-indigo-50 dark:bg-indigo-400 text-gray-700 dark:text-white font-semibold' : '' }} text-sm py-3 my-0 mx-2 flex items-center whitespace-nowrap px-4 font-medium text-gray-500 dark:text-white hover:bg-indigo-50 dark:hover:bg-indigo-400 rounded-lg shadow-none transition-colors ease-in-out">
                    <i class="fa-solid fa-users"></i>
                    <span class="mx-2 text-sm font-medium">@lang('main.users')</span>
                </Link>
            @endcan

            {{-- Plugins --}}
            @can('read plugins')
                <Link href="{{ route('dashboard.plugins.index') }}" class="{{ request()->routeIs('dashboard.plugins.index') ? 'bg-indigo-50 dark:bg-indigo-400 text-gray-700 dark:text-white font-semibold' : '' }} text-sm py-3 my-0 mx-2 flex items-center whitespace-nowrap px-4 font-medium text-gray-500 dark:text-white hover:bg-indigo-50 dark:hover:bg-indigo-400 rounded-lg shadow-none transition-colors ease-in-out">
                    <i class="fa-solid fa-puzzle-piece"></i>
                    <span class="mx-2 text-sm font-medium">@lang('main.plugins')</span>
                </Link>
            @endcan

            @can('update settings')
                <Link href="{{ route('dashboard.settings.index') }}" class="{{ request()->routeIs('dashboard.settings.index') ? 'bg-indigo-50 dark:bg-indigo-400 text-gray-700 dark:text-white font-semibold' : '' }} text-sm py-3 my-0 mx-2 flex items-center whitespace-nowrap px-4 font-medium text-gray-500 dark:text-white hover:bg-indigo-50 dark:hover:bg-indigo-400 rounded-lg shadow-none transition-colors ease-in-out">
                    <i class="fa-solid fa-gear"></i>
                    <span class="mx-2 text-sm font-medium">@lang('main.settings')</span>
                </Link>
            @endcan
        </nav>
    </div>
</aside>