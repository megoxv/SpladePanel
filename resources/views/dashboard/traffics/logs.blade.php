@seoTitle(__('main.traffics_logs'))

<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-white rounded-lg">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-semibold">@lang('main.traffics_logs')</h1>
            </div>

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
        </div>
    </div>
</x-dashboard-layout>
