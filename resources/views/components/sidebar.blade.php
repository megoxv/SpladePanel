<aside  :class="{'block': sidebar.open, 'hidden': ! sidebar.open}" class=" lg:flex fixed top-0 lrt:left-0 rtl:right-0 bottom-0 z-[60] flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">
    <Link href="{{ route('dashboard.index') }}" class="flex items-center lrt:mr-10 rtl:mr-0 rtl:ml-10">
        <x-application-logo class="block h-9 w-auto" />
    </Link>

    <div class="flex flex-col justify-between flex-1 mt-6">
        <nav class="flex-1 -mx-3 space-y-3 ">
            {{-- Home Dashboard --}}
            <Link href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'bg-gray-100 dark:bg-gray-800 dark:text-gray-200 text-gray-700' : '' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span class="mx-2 text-sm font-medium">@lang('main.home')</span>
            </Link>

            {{-- Plugins --}}
            @php
                $plugins = Module::allEnabled();
            @endphp

            @foreach($plugins as $plugin)
                {{-- @can($plugin->get('alias').' read') --}}
                    <Link away href="{{ route('dashboard.' . $plugin->get('alias') . '.index') }}" class="{{ request()->routeIs('dashboard.' . $plugin->get('alias') . '.index') ? 'bg-gray-100 dark:bg-gray-800 dark:text-gray-200 text-gray-700' : '' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                        <i class="{{ $plugin->get('icon') }}"></i>
                        <span class="mx-2 text-sm font-medium">{{$plugin->get('name')}}</span>
                    </Link>
                {{-- @endcan --}}
            @endforeach

            {{-- Reports --}}
            @can('read reports')
                <x-splade-dropdown class="w-full">
                    <x-slot:trigger>
                        <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="#">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span class="mx-2 text-sm font-medium">@lang('main.reports')</span>
                        </a>
                    </x-slot>
                    <div class="w-48 mt-2 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 py-1 bg-white">

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
                <Link href="{{ route('dashboard.languages.index') }}" class="{{ request()->routeIs('dashboard.languages.index') ? 'bg-gray-100 dark:bg-gray-800 dark:text-gray-200 text-gray-700' : '' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                    <i class="fa-solid fa-language"></i>
                    <span class="mx-2 text-sm font-medium">@lang('main.languages')</span>
                </Link>
            @endcan

            {{-- Permissions --}}
            @can('read permissions')
                <Link href="{{ route('dashboard.permissions.index') }}" class="{{ request()->routeIs('dashboard.permissions.index') ? 'bg-gray-100 dark:bg-gray-800 dark:text-gray-200 text-gray-700' : '' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                    <i class="fa-solid fa-fingerprint"></i>
                    <span class="mx-2 text-sm font-medium">@lang('main.permissions')</span>
                </Link>
            @endcan

            {{-- Roles --}}
            @can('read roles')
                <Link href="{{ route('dashboard.roles.index') }}" class="{{ request()->routeIs('dashboard.roles.index') ? 'bg-gray-100 dark:bg-gray-800 dark:text-gray-200 text-gray-700' : '' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                    <i class="fa-solid fa-key"></i>
                    <span class="mx-2 text-sm font-medium">@lang('main.roles')</span>
                </Link>
            @endcan

            {{-- Users --}}
            @can('read users')
                <Link href="{{ route('dashboard.user.index') }}" class="{{ request()->routeIs('dashboard.user.index') ? 'bg-gray-100 dark:bg-gray-800 dark:text-gray-200 text-gray-700' : '' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                    <i class="fa-solid fa-users"></i>
                    <span class="mx-2 text-sm font-medium">@lang('main.users')</span>
                </Link>
            @endcan

            {{-- Plugins --}}
            @can('read plugins')
                <Link href="{{ route('dashboard.plugins.index') }}" class="{{ request()->routeIs('dashboard.plugins.index') ? 'bg-gray-100 dark:bg-gray-800 dark:text-gray-200 text-gray-700' : '' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                    <i class="fa-solid fa-puzzle-piece"></i>
                    <span class="mx-2 text-sm font-medium">@lang('main.plugins')</span>
                </Link>
            @endcan

            @can('update settings')
                <Link href="{{ route('dashboard.settings.index') }}" class="{{ request()->routeIs('dashboard.settings.index') ? 'bg-gray-100 dark:bg-gray-800 dark:text-gray-200 text-gray-700' : '' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                    <i class="fa-solid fa-gear"></i>
                    <span class="mx-2 text-sm font-medium">@lang('main.settings')</span>
                </Link>
            @endcan
        </nav>

        <div class="mt-6">
            <x-splade-dropdown class="w-full">
                @php
                    $languages = \App\Models\Language::where('status', 1)->orderBy('name', 'asc')->get();
                @endphp
                <x-slot:trigger>
                    <button type="button" class=" py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md bg-white text-slate-700 align-middle hover:bg-slate-50 focus:outline-none transition-all text-sm dark:bg-slate-800 dark:hover:bg-slate-700  dark:text-slate-400 dark:hover:text-white dark:focus:ring-offset-slate-800">
                        @foreach ( $languages as $language )
                            @if (App::getLocale() == $language->code)
                                <img src="{{ asset('assets/flags/' . $language->icon . '.svg') }}" alt="{{ $language->code }}" loading="lazy" class="w-5 h-5 rounded" />
                                {{ $language->name }}
                            @endif
                        @endforeach
                    </button>
                </x-slot>

                <div class="w-48 mt-2 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 py-1 bg-white">
                    @foreach ( $languages as $language )
                        <x-dropdown-link away :href="route('switch-language', $language->code)" class="flex items-center gap-x-2">
                            <img src="{{ asset('assets/flags/' . $language->icon . '.svg') }}" alt="{{ $language->code }}" loading="lazy" class="w-5 h-5 rounded" />
                            {{ $language->name }}
                        </x-dropdown-link>
                    @endforeach
                </div>
            </x-splade-dropdown>

            <div class="flex items-center justify-between mt-6">
                <x-splade-dropdown>
                    <x-slot:trigger>
                        @if(\Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="flex items-center gap-x-2">
                                <img class="object-cover rounded-full h-9 w-9" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ auth()->user()->name }}</span>
                            </div>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ auth()->user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </x-slot>

                    <div class="w-48 mt-2 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 py-1 bg-white">
                        {{-- Account Management --}}
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            @lang('main.manage_account')
                        </div>

                        <x-dropdown-link :href="route('profile.show')">
                            @lang('main.profile')
                        </x-dropdown-link>

                        @if(\Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link :href="route('api-tokens.index')">
                                @lang('main.api_tokens')
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200" />

                        {{-- Authentication --}}
                        <x-splade-form :action="route('logout')">
                            <x-dropdown-link as="button">
                                @lang('main.logout')
                            </x-dropdown-link>
                        </x-splade-form>
                    </div>
                </x-splade-dropdown>

                <x-splade-form :action="route('logout')">
                    <button type="submit" class="text-gray-500 transition-colors duration-200 rotate-180 dark:text-gray-400 rtl:rotate-0 hover:text-blue-500 dark:hover:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </button>
                </x-splade-form>
            </div>
        </div>
    </div>
</aside>