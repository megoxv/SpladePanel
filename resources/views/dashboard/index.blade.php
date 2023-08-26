@seoTitle(__('main.dashboard'))

<x-dashboard-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('main.dashboard')
        </h2>
    </x-slot>

    <x-section-content>
        <x-welcome />
    </x-section-content>
</x-app-layout>