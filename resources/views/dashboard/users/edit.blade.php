@seoTitle(__('main.users'))

<x-dashboard-layout>
    {{-- Head --}}
    <div class="flex justify-between items-end mb-4">
        <div>
            <nav class="fi-breadcrumbs mb-2 hidden sm:block">
                <ul class="flex flex-wrap items-center gap-x-2">
                    <li class="flex gap-x-2">
                        <Link href="{{ route('dashboard.user.index') }}"
                            class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            @lang('main.users')
                        </Link>
                    </li>
                    <li class="flex items-center gap-x-2">
                        <i class="fa-solid fa-chevron-right text-gray-400 dark:text-gray-500 text-xs rtl:rotate-180"></i>
                        <a href="#" class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200">
                            @lang('main.edit')
                        </a>
                    </li>
                </ul>
            </nav>
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                @lang('main.edit_profile_information')
            </h1>
        </div>
        <div>
        </div>
    </div>
    {{-- Content --}}
    <x-section-content>
        <x-splade-form :action="route('dashboard.user.update', $user)" method="PUT" :default="$user" class="space-y-4">
            {{-- Profile Photo --}}
            @if(Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="col-span-6 sm:col-span-4">
                    <span class="block mb-1 text-gray-700 dark:text-gray-300 font-sans">@lang('main.photo')</span>

                    {{-- Current Profile Photo --}}
                    <div v-show="!form.photo" class="mt-2">
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-full h-20 w-20 object-cover">
                    </div>

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

                        <x-splade-rehydrate on="profile-information-updated">
                            @if($user->profile_photo_path)
                                <x-splade-link method="delete" :href="route('current-user-photo.destroy')" class="inline-block py-2 px-3 rounded-md border border-gray-300 shadow-sm bg-white hover:bg-gray-100 relative cursor-pointer font-medium text-gray-700 text-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:border-indigo-300 focus:ring-indigo-200">
                                    @lang('main.remove_photo')
                                </x-splade-link>
                            @endif
                        </x-splade-rehydrate>
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
            {{-- Roles --}}
            <x-splade-select name="roles[]" :label="__('main.roles')" :options="$roles" option-value="name" multiple relation choices required />
            {{-- Permissions --}}
            <x-splade-select name="permissions[]" :label="__('main.permissions')" :options="$permissions" multiple relation choices />            
            {{-- New Password --}}
            <x-splade-input name="new_password" :label="__('main.new_password')" />
            {{-- Update Button --}}
            <x-splade-submit :label="__('main.save')" />
        </x-splade-form>
    </x-section-content>
</x-dashboard-layout>
