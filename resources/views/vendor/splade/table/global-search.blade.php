<div class="relative">
    <input
        class="block w-full ltr:sm:pl-9 rtl:sm:pr-9 text-sm rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-200 focus:ring-indigo-500 dark:focus:ring-indigo-600 focus:border-indigo-500 dark:focus:border-indigo-600 border-gray-300 dark:border-gray-600"
        placeholder="{{ $table->searchInputs('global')->label }}"
        value="{{ $table->searchInputs('global')->value }}"
        type="text"
        name="searchInput-global"
        v-bind:class="{ 'opacity-50': table.isLoading }"
        v-bind:disabled="table.isLoading"
        @input="table.debounceUpdateQuery('filter[global]', $event.target.value, $event.target)"
    >
    <div class="absolute inset-y-0 ltr:left-0 rtl:right-0 ltr:pl-3 rtl:pr-3 hidden sm:flex items-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-300" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
    </div>
</div>