<SpladeJoditEditor
    {{ $attributes->only(['v-if', 'v-show', 'class']) }}
    :options="@js($joditOptions())"
    :js-options="{!! $jsJoditOptions() !!}"
    v-model="{{ $vueModel() }}"
    :dusk="@js($attributes->get('dusk'))"
>
    <label class="block">
        @includeWhen($label, 'splade::form.label', ['label' => $label])

        <textarea {{ $attributes->except(['v-if', 'v-show', 'class'])->class(
            'block w-full border-0 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed dark:bg-gray-800 dark:text-gray-300'
        )->merge([
            'name' => $name,
            'v-model' => $vueModel(),
            'data-validation-key' => $validationKey(),
        ]) }}></textarea>
    </label>

    @includeWhen($help, 'splade::form.help', ['help' => $help])
    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</SpladeJoditEditor>
