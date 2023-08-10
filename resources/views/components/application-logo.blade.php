@if (getSetting('light_logo') && getSetting('dark_logo'))
    <div class="flex justify-center gap-4">
        <img src="{{ light_logo() }}" alt="{{ getSetting('website_name') }}" loading="lazy" class="dark:hidden lrt:mr-3 rtl:ml-3 rounded-lg">
        <img src="{{ dark_logo() }}" alt="{{ getSetting('website_name') }}" loading="lazy" class="hidden dark:block lrt:mr-3 rtl:ml-3 rounded-lg">
    </div>
@else
    <span class="self-center text-lg font-semibold whitespace-nowrap text-gray-900 dark:text-white">{{ getSetting('website_name') }}</span>
@endif