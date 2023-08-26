<x-splade-component is="dropdown" {{ $attributes->class('w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm px-2.5 sm:px-4 py-2 inline-flex justify-center text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500') }}>
    <x-slot:trigger>
        {{ $button }}
    </x-slot:trigger>

    <div class="mt-2 min-w-max p-1 divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10">
        {{ $slot }}
    </div>
</x-splade-component>
