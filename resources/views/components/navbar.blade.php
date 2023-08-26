<nav>
    <ul class="flex justify-end max-w-7xl mx-auto py-4 space-x-4 rtl:space-x-reverse">
        {{-- Dark/Light Toggle --}}
        <li>
            <div class="px-3.5 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 rounded-full inline-flex justify-center items-center gap-2 hover:bg-indigo-100 dark:hover:bg-indigo-400/90 dark:hover:text-white border-2 hover:border-indigo-600 transition-colors group border-gray-400 dark:border-gray-400 dark:hover:border-indigo-700">
                <a href="javascript:;"  class="dark:hidden block dark-mode group flex items-center" data-theme-click-value="dark">
                    <i class="fa-regular fa-sun text-sm"></i>
                </a>
                <a href="javascript:;"  class="dark:block hidden dark-mode group flex items-center" data-theme-click-value="light">
                    <i class="fa-regular fa-moon text-sm"></i>
                </a>
            </div>
        </li>
        {{-- Languages Switch --}}
        <li class="relative flex items-center">
            <x-splade-dropdown class="w-full">
                @php
                    $languages = \App\Models\Language::where('status', 1)->orderBy('name', 'asc')->get();
                @endphp
                <x-slot:trigger>
                    <button class="space-x-2 rtl:space-x-reverse px-3.5 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 rounded-full inline-flex justify-center items-center gap-2 hover:bg-indigo-100 dark:hover:bg-indigo-400/90 dark:hover:text-white border-2 hover:border-indigo-600 transition-colors group border-gray-400 dark:border-gray-400 dark:hover:border-indigo-700">
                        @foreach ( $languages as $language )
                            @if (App::getLocale() == $language->code)
                                <img src="{{ asset('assets/flags/' . $language->icon . '.svg') }}" alt="{{ $language->code }}" loading="lazy" class="w-5 h-5 rounded" />
                                {{ $language->name }}
                            @endif
                        @endforeach
                        <i class="fa-solid fa-chevron-down text-sm text-gray-500 dark:text-gray-300"></i>
                    </button>
                </x-slot>

                <div class="w-48 mt-2 p-1 divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10">
                    @foreach ( $languages as $language )
                        <x-dropdown-link away :href="route('switch-language', $language->code)">
                            <img src="{{ asset('assets/flags/' . $language->icon . '.svg') }}" alt="{{ $language->code }}" loading="lazy" class="w-5 h-5 rounded" />
                            {{ $language->name }}
                        </x-dropdown-link>
                    @endforeach
                </div>
            </x-splade-dropdown>        
        </li>
        {{-- User Profile --}}
        <li class="relative flex items-center">
            <x-splade-dropdown>
                <x-slot:trigger>
                    <div class="space-x-2 rtl:space-x-reverse px-3.5 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 rounded-full inline-flex justify-center items-center gap-2 hover:bg-indigo-100 dark:hover:bg-indigo-400/90 dark:hover:text-white border-2 hover:border-indigo-600 transition-colors group border-gray-400 dark:border-gray-400 dark:hover:border-indigo-700">
                        @if (\Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="flex items-center gap-x-2">
                                <img class="object-cover rounded-full h-5 w-5" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ auth()->user()->name }}</span>
                            </div>
                        @else
                            <span class="inline-flex rounded-md">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ auth()->user()->name }}
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                        <i class="fa-solid fa-chevron-down text-sm text-gray-500 dark:text-gray-300"></i>
                    </div>
                </x-slot>

                    <div class="w-48 mt-2 p-1 divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10">
                        <x-dropdown-link :href="route('profile.show')">
                            <i class="fa-regular fa-circle-user"></i>
                            @lang('main.profile')
                        </x-dropdown-link>

                        @if (\Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link :href="route('api-tokens.index')">
                                <i class="fa-solid fa-code"></i>
                                @lang('main.api_tokens')
                            </x-dropdown-link>
                        @endif

                        {{-- Authentication --}}
                        <x-splade-form :action="route('logout')">
                            <x-dropdown-link as="button">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                @lang('main.logout')
                            </x-dropdown-link>
                        </x-splade-form>
                    </div>
            </x-splade-dropdown>
        </li>
        {{-- Sidebar Toggle --}}
        <li class="flex items-center xl:hidden">
            <button class="space-x-2 rtl:space-x-reverse px-3.5 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 rounded-full inline-flex justify-center items-center gap-2 hover:bg-indigo-100 dark:hover:bg-indigo-400/90 dark:hover:text-white border-2 hover:border-indigo-600 transition-colors group border-gray-400 dark:border-gray-400 dark:hover:border-indigo-700" @click="sidebar.open = ! sidebar.open">
                <svg
                    class="h-4 w-4"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        :class="{'hidden': sidebar.open, 'inline-flex': ! sidebar.open }"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                    <path
                        :class="{'hidden': ! sidebar.open, 'inline-flex': sidebar.open }"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </li>
    </ul>
</nav>
