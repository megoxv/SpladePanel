<div {{ $attributes->only(['v-if', 'v-show', 'class']) }}>
    <label class="flex items-center">
        <input {{ $attributes->except(['v-if', 'v-show', 'class'])->class(
            'rounded-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50'
        )->merge([
            'name' => $name,
            'value' => $value,
            'type' => 'radio',
            'v-model' => $vueModel(),
            'data-validation-key' => $validationKey(),
        ]) }}
        />

        @if(trim($slot))
            <span class="ltr:ml-2 rtl:mr-2 text-gray-700 dark:text-gray-300 font-sans">{{ $slot }}</span>
        @else
            <span class="ltr:ml-2 rtl:mr-2 text-gray-700 dark:text-gray-300 font-sans">{{ $label }}</span>
        @endif
    </label>

    @includeWhen($help, 'splade::form.help', ['help' => $help])
    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
  </div>


