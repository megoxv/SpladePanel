<x-banner />

<div class="min-h-screen bg-gray-100">
    <x-splade-data store="sidebar" default="{ open: false }" />
    <x-sidebar />

    <div class="w-full pt-10 px-4 sm:px-6 md:px-8 ltr:lg:pl-72 rtl:lg:pl-0 rtl:lg:pr-72">
        <x-header />
        <main>
            {{ $slot }}
        </main>
    </div>
</div>
