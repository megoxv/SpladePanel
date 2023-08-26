<x-splade-component is="dropdown" dusk="select-rows-dropdown" close-on-click>
    <x-slot:trigger>
        <input
            type="checkbox"
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50"
            :checked="table.allVisibleItemsAreSelected"
        />
    </x-slot:trigger>

    <div class="mt-2 min-w-max rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5">
        <div class="flex flex-col">
            <button
                class="text-left w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-gray-900 font-normal"
                @click="table.setSelectedItems(@js($table->getPrimaryKeys()))"
                dusk="select-all-on-this-page">
                {{ __('main.select_all_on_this_page') }} ({{ $table->totalOnThisPage() }})
            </button>

            @if($showPaginator())
                <button
                    class="text-left w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-gray-900 font-normal"
                    @click="table.setSelectedItems(['*'])"
                    dusk="select-all-results">
                    {{ __('main.select_all_results') }} ({{ $table->totalOnAllPages() }})
                </button>
            @endif

            <button
                v-if="table.hasSelectedItems"
                class="text-left w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-gray-900 font-normal"
                @click="table.setSelectedItems([])"
                dusk="select-none">
                {{ __('main.clear_selection') }}
            </button>
        </div>
    </div>
</x-splade-component>