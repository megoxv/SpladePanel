@seoTitle(__('main.traffics'))

<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-white rounded-lg">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-semibold">@lang('main.traffics')</h1>
            </div>

            <x-splade-table :for="$traffics">
                <x-splade-cell country>
                    <img src="{{ asset("assets/flags/$item->country_code.svg") }}" alt="{{ $item->country_code }}" width="25">
                    {{ $item->country_name }}
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-dashboard-layout>
