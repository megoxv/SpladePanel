<span class="block mb-1 text-gray-700 dark:text-gray-300 font-sans">
    {!! $label !!}
    @if($attributes->has('required') || $attributes->has('data-required'))
        <span aria-hidden="true" class="text-red-600" title="{{ __('main.this_field_is_required') }}">*</span>
    @endif
</span>
