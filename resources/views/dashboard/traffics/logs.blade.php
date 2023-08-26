@seoTitle(__('main.traffics_logs'))

<x-dashboard-layout>
    {{-- Head --}}
    <div class="flex justify-between items-end mb-4">
        <div>
            <nav class="fi-breadcrumbs mb-2 hidden sm:block">
                <ul class="flex flex-wrap items-center gap-x-2">
                    <li class="flex gap-x-2">
                        <Link href="{{ route('dashboard.traffics.index') }}"
                            class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            @lang('main.traffics')
                        </Link>
                    </li>
                    <li class="flex items-center gap-x-2">
                        <i class="fa-solid fa-chevron-right text-gray-400 dark:text-gray-500 text-xs rtl:rotate-180"></i>
                        <a href="#" class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            @lang('main.traffics_logs')
                        </a>
                    </li>
                </ul>
            </nav>
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                @lang('main.traffics_logs')
            </h1>
        </div>
        <div>
        </div>
    </div>
    {{-- Content --}}
    <x-section-content>
        <x-splade-table :for="$logs">
            <x-splade-cell coming_from as="$log">
                <Link href="{{ $log->rate_limit->prev_link }}">
                    {{ substr($log->rate_limit->prev_link, 0, 40) }}
                </Link>
            </x-splade-cell>

            <x-splade-cell entered as="$log">
                <Link href="{{ $log->url }}">
                {{ substr($log->url, 0, 40) }}
                </Link>
            </x-splade-cell>

            <x-splade-cell device_details as="$log">
                @php
                    $country_code = $log->rate_limit->country_code
                @endphp
                {{$log->rate_limit->browser}} - {{$log->rate_limit->device}} - {{$log->rate_limit->operating_system}} -
                <img src="{{ asset("assets/flags/$country_code.svg") }}" alt="{{ $log->rate_limit->$country_code }}" width="25"> {{$log->rate_limit->country_name}}
            </x-splade-cell>
        </x-splade-table>
    </x-section-content>
</x-dashboard-layout>
