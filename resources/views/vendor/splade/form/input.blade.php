@php $flatpickrOptions = $flatpickrOptions() @endphp

<SpladeInput
    {{ $attributes->only(['v-if', 'v-show', 'v-for', 'class'])->class(['hidden' => $isHidden()]) }}
    :flatpickr="@js($flatpickrOptions)"
    :js-flatpickr-options="{!! $jsFlatpickrOptions !!}"
    v-model="{{ $vueModel() }}"
    #default="inputScope"
>
    <label class="block">
        @includeWhen($label, 'splade::form.label', ['label' => $label])

        <div class="flex rounded-md shadow-sm">
            @if($prepend)
                <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnablePrepend) }" class="inline-flex items-center px-3 ltr:rounded-l-md rtl:rounded-r-md border border-t-0 border-b-0 ltr:border-l-0 rtl:border-r-0 border-gray-300 bg-gray-50 dark:bg-gray-800 text-gray-500 dark:text-gray-300">
                    {!! $prepend !!}
                </span>
            @endif

            <input {{ $attributes->except(['v-if', 'v-show', 'v-for', 'class'])->class([
                'block w-full border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:focus:border-indigo-400 dark:focus:ring-indigo-300 placeholder:text-gray-300',
                'rounded-md' => !$append && !$prepend,
                'min-w-0 flex-1 rounded-none' => $append || $prepend,
                'ltr:rounded-l-md rtl:rounded-r-md' => $append && !$prepend,
                'ltr:rounded-r-md rtl:rounded-l-md' => !$append && $prepend,
            ])->merge([
                'name' => $name,
                'type' => $type,
                'data-validation-key' => $validationKey(),
            ])->when(!$flatpickrOptions, fn($attributes) => $attributes->merge([
                'v-model' => $vueModel(),
            ])) }}
            />

            @if($append)
                <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnableAppend) }" class="inline-flex items-center px-3 ltr:rounded-r-md rtl:rounded-l-md border border-t-0 border-b-0 ltr:border-r-0 rtl:border-l-0 border-gray-300 bg-gray-50 text-gray-500 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-indigo-400 dark:focus:ring-indigo-300">
                    {!! $append !!}
                </span>
            @endif
        </div>
    </label>

    @include('splade::form.help', ['help' => $help])
    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</SpladeInput>