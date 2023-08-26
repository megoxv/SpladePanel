@props(['as' => false])

<div>
    @if($as === 'button')
        <button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 hover:bg-gray-50 focus:bg-gray-50 dark:hover:bg-white/5 dark:focus:bg-white/5 dark:text-white']) }}>
            {{ $slot }}
        </button>
    @elseif($as === 'a')
        <a {{ $attributes->merge(['class' => 'flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 hover:bg-gray-50 focus:bg-gray-50 dark:hover:bg-white/5 dark:focus:bg-white/5 dark:text-white']) }}>
            {{ $slot }}
        </a>
    @else
        <Link {{ $attributes->merge(['class' => 'flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 hover:bg-gray-50 focus:bg-gray-50 dark:hover:bg-white/5 dark:focus:bg-white/5 dark:text-white']) }}>
            {{ $slot }}
        </Link>
    @endif
</div>