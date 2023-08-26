<x-banner />

<x-sidebar />

<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <x-splade-data store="sidebar" default="{ open: false }" />
    <div class="w-full px-4 sm:px-6 md:px-8 ltr:xl:pl-72 rtl:xl:pl-0 rtl:xl:pr-72">
        <x-navbar />
        <main class="max-w-7xl mx-auto py-12">
            {{ $slot }}
        </main>
    </div>
</div>
