@seoTitle(__('main.error_reports'))

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
                            @lang('main.error_reports')
                        </a>
                    </li>
                </ul>
            </nav>
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                @lang('main.error_reports')
            </h1>
        </div>
        <div>
        </div>
    </div>
    {{-- Content --}}
    <x-section-content>
        <x-splade-table :for="$reports">
            <x-splade-cell url as="$report">
                <Link href="{{ $report->url }}">
                    {{ $report->url }}
                </Link>
            </x-splade-cell>

            <x-splade-cell action as="$report">
                <Link href="{{route('dashboard.traffics.error-report', $report)}}">
                    <span class="btn btn-success"><span class="fas fa-search"></span></span>
                </Link>
            </x-splade-cell>
        </x-splade-table>
    </x-section-content>
</x-dashboard-layout>
