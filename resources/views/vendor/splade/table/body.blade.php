<tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
    @forelse($table->resource as $itemKey => $item)
        <tr
            :class="{
                'bg-gray-50 dark:bg-gray-800': table.striped && @js($itemKey) % 2,
                'hover:bg-gray-100 dark:hover:bg-gray-700': table.striped,
                'hover:bg-gray-50 dark:hover:bg-gray-800': !table.striped
            }"
        >
            @if($hasBulkActions = $table->hasBulkActions())
                <td width="64" class="text-xs px-6 py-4">
                    @php $itemPrimaryKey = $table->findPrimaryKey($item) @endphp

                    <input
                        @change="(e) => table.setSelectedItem(@js($itemPrimaryKey), e.target.checked)"
                        :checked="table.itemIsSelected(@js($itemPrimaryKey))"
                        :disabled="table.allItemsFromAllPagesAreSelected"
                        class="whitespace-nowrap text-sm @if($loop->first && $hasBulkActions) ltr:pr-6 rtl:pl-6 @else px-6 @endif py-4 @if($column->highlight) text-gray-900 font-medium dark:text-gray-300 @else text-gray-500 dark:text-gray-400 @endif @if($table->rowLinks->has($itemKey)) cursor-pointer @endif {{ $column->classes }}"
                        name="table-row-bulk-action"
                        type="checkbox"
                        value="{{ $itemPrimaryKey }}"
                    />
                </td>
            @endif

            @foreach($table->columns() as $column)
                <td
                    @if($table->rowLinks->has($itemKey))
                        @click="(event) => table.visit(@js($table->rowLinks->get($itemKey)), @js($table->rowLinkType), event)"
                    @endif
                    v-show="table.columnIsVisible(@js($column->key))"
                    class="whitespace-nowrap text-sm @if($loop->first && $hasBulkActions) ltr:pr-6 rtl:pl-6 @else px-6 @endif py-4 @if($column->highlight) text-gray-900 font-medium dark:text-gray-300 @else text-gray-500 dark:text-gray-400 @endif @if($table->rowLinks->has($itemKey)) cursor-pointer @endif {{ $column->classes }}"
                >
                    <div class="flex flex-row items-center @if($column->alignment == 'right') justify-end @elseif($column->alignment == 'center') justify-center @else justify-start @endif">
                        @isset(${'spladeTableCell' . $column->keyHash()})
                            {{ ${'spladeTableCell' . $column->keyHash()}($item, $itemKey) }}
                        @else
                            {!! nl2br(e($getColumnDataFromItem($item, $column))) !!}
                        @endisset
                    </div>
                </td>
            @endforeach
        </tr>
    @empty
        <tr>
            <td colspan="{{ $table->columns()->count() }}" class="whitespace-nowrap">
                @if(isset($emptyState) && !!$emptyState)
                    {{ $emptyState }}
                @else
                    <p class="text-gray-700 px-6 py-12 font-medium text-sm text-center">
                        {{ __('main.there_are_no_items_to_show.') }}
                    </p>
                @endif
            </td>
        </tr>
    @endforelse
</tbody>
