@seoTitle(__('main.users'))

<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-white rounded-lg">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-semibold">@lang('main.users')</h1>
                <div>
                    @can('create users')
                        <x-btn-link href="#create">
                            @lang('main.add_new')
                        </x-btn-link>
                    @endcan
                </div>
            </div>
            {{-- Create Modal --}}
            @can('create users')
                <x-splade-modal name="create">
                    <x-splade-form :action="route('dashboard.user.store')" method="POST" class="space-y-4">
                        <h3 class="text-xl font-medium text-gray-900">
                            @lang('main.profile_information')
                        </h3>
                        {{-- Profile Photo --}}
                        @if(Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="col-span-6 sm:col-span-4">
                                <span class="block mb-1 text-gray-700 font-sans">@lang('main.photo')</span>

                                {{-- New Profile Photo Preview --}}
                                <div v-show="form.photo" class="mt-2">
                                    <span
                                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                        :style="'background-image: url(\'' + form.$fileAsUrl('photo') + '\');'"
                                    />
                                </div>
        
                                {{-- Profile Photo File Input --}}
                                <div class="flex mt-2 space-x-2">
                                    <x-splade-file name="photo" :show-filename="false">
                                        @lang('main.select_a_new_photo')
                                    </x-splade-file>
                                </div>
                            </div>
                        @endif
                        {{-- Name --}}
                        <x-splade-input v-model="form.name" name="name" :label="__('main.name')" autocomplete="name" required />
                        {{-- Username --}}
                        <x-splade-input v-model="form.username" name="username" :label="__('main.username')" autocomplete="username" required />
                        {{-- Email --}}
                        <x-splade-input v-model="form.email" name="email" :label="__('main.email')" autocomplete="email" required />
                        {{-- Bio --}}
                        <x-splade-textarea v-model="form.bio" name="bio" :label="__('main.bio')" autocomplete="bio" autosize />
                        {{-- Status --}}
                        @php
                            $status_options = [
                                'Active' => __('main.active'),
                                'Banned' => __('main.banned'),
                            ];
                        @endphp
                        <x-splade-select name="status" :label="__('main.status')" :options="$status_options" choices required />
                        {{-- Password --}}
                        <x-splade-input type="password" name="password" :label="__('main.password')" required />
                        {{-- Roles --}}
                        <x-splade-select name="roles[]" :label="__('main.roles')" :options="$roles" multiple relation choices required />
                        {{-- Permissions --}}
                        <x-splade-select name="permissions[]" :label="__('main.permissions')" :options="$permissions" multiple relation choices />            
                        {{-- Submit Button --}}
                        <x-splade-submit :label="__('main.submit')" />
                    </x-splade-form>
                </x-splade-modal>
            @endcan
            <x-splade-table :for="$users">
                <x-splade-cell roles as="$user">
                    @foreach($user->getRoleNames() as $role)
                        {{ $role }}, 
                    @endforeach
                </x-splade-cell>
                <x-splade-cell actions as="$user">
                    {{-- Edit --}}
                    @can('update users')
                        <x-nav-link href="{{ route('dashboard.user.edit', $user) }}"> 
                            @lang('main.edit')
                        </x-nav-link>
                    @endcan
                    {{-- Delete --}}
                    @can('delete users')
                        <x-nav-link href="{{ route('dashboard.user.destroy', $user) }}" method="DELETE" confirm="{{ __('main.confirm_delete_user') }}" confirm-text="{{ __('main.confirm_text_delete_user') }}" class="text-red-600"> 
                            @lang('main.delete')
                        </x-nav-link>
                    @endcan
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-dashboard-layout>
