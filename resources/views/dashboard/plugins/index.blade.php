@seoTitle(__('main.plugins'))

<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-white rounded-lg">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-semibold">@lang('main.plugins')</h1>
                <div>
                    @can('create plugins')
                        <x-btn-link href="{{ route('dashboard.plugins.create') }}">
                            @lang('main.add_plugin')
                        </x-btn-link>
                    @endcan
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2">
                @php
                    $plugins = Module::all();
                @endphp

                @foreach ($plugins as $plugin)
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="flex">
                            <div class="h-32 min-w-[8rem] min-h-full p-4 flex items-center justify-center rounded-2xl mr-3"
                                style="background-color: {{ $plugin->get('color') }}">
                                <i class="{{ $plugin->get('icon') }} text-5xl text-white"></i>
                            </div>
                            <div>
                                <div class="flex justify-between mb-2">
                                    <h6 class="text-xl font-bold">{{ $plugin->get('title') }}</h6>
                                    <div class="flex items-center">
                                        @can('update plugins')
                                            @if ($plugin->isEnabled())
                                                <x-nav-link href="{{ route('dashboard.plugins.deactivate', ['plugin' => $plugin->get('name')]) }}" method="POST"> 
                                                    @lang('main.deactivate')
                                                </x-nav-link>
                                            @else
                                                <x-nav-link href="{{ route('dashboard.plugins.activate', ['plugin' => $plugin->get('name')]) }}" method="POST"> 
                                                    @lang('main.activate')
                                                </x-nav-link>
                                            @endif
                                        @endcan
                                        @can('delete plugins')
                                            <span class="mx-1">|</span>
                                            <x-nav-link href="{{ route('dashboard.plugins.delete', ['plugin' => $plugin->get('name')]) }}" method="POST" confirm="{{ __('main.confirm_delete_plugin') }}" confirm-text="{{ __('main.confirm_text_delete_plugin') }}" class="text-red-600"> 
                                                @lang('main.delete')
                                            </x-nav-link>
                                        @endcan
                                    </div>
                                </div>
                                <p class="text-sm">{{ $plugin->get('description') }}</p>
                                <p class="text-sm mt-2">
                                    <span>@lang('main.by') <strong>{{ $plugin->get('author') }}</strong></span> <span>&#x2022; @lang('main.version'){{ $plugin->get('version') }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-dashboard-layout>
