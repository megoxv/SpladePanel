@seoTitle(__('main.error_reports'))

<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-white rounded-lg">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-semibold">@lang('main.error_reports')</h1>
            </div>

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
        </div>
    </div>
</x-dashboard-layout>
