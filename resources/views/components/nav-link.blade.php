@props(['active' => false])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-gray-300 text-sm font-medium leading-5 text-gray-900 dark:text-gray-300 focus:outline-none focus:border-indigo-700 dark:focus:border-gray-500 transition duration-150 ease-in-out'
    : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-500 transition duration-150 ease-in-out';
@endphp

<Link {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</Link>
