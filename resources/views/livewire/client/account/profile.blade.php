<div>
    <div class="flex justify-between items-end">
        <h1 class="text-2xl font-semibold text-gray-900">{{ __('Edit my profile') }}</h1>
        <p class="text-sm text-gray-600">{{ __('Last update:') }} {{ $user->updated_at->diffForHumans() }}</p>
    </div>
    <form wire:submit.prevent="save">
        <div class="mt-6 sm:mt-5">
            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                <x-input.label>{{ __('Identity') }}</x-input.label>

                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <x-input.text wire:model="user.first_name" placeholder="{{ __('First Name') }}" />
                            @error('user.first_name')
                                <div class="mt-1 text-red-500 text-sm">
                                    {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-input.text wire:model="user.last_name" placeholder="{{ __('Last Name') }}" />
                            @error('user.last_name')
                                <div class="mt-1 text-red-500 text-sm">
                                    {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- @error('user.username')
                        <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                    @enderror --}}
                </div>
            </div>

            <div
                class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                <x-input.label>{{ __('Email & Phone Number') }}</x-input.label>

                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <x-input.text wire:model="user.email" placeholder="{{ __('Email') }}" />
                            @error('user.email')
                                <div class="mt-1 text-red-500 text-sm">
                                    {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-input.text wire:model="client.phone" placeholder="{{ __('Phone Number') }}" />
                            @error('client.phone')
                                <div class="mt-1 text-red-500 text-sm">
                                    {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                <x-input.label>{{ __('Country & Address') }}</x-input.label>

                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <x-input.text wire:model="client.country" placeholder="{{ __('Country') }}" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-input.text wire:model="client.address" placeholder="{{ __('Adress') }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="photo" class="block text-sm leading-5 font-medium text-gray-700">
                    Photo
                </label>

                <div class="mt-2 sm:mt-0 sm:col-span-2">
                    <x-input.file-upload wire:model="upload" id="photo">
                        <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                            @if ($upload)
                                <img src="{{ $upload->temporaryUrl() }}" alt="Profile Photo">
                            @else
                                <img src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
                            @endif
                        </span>
                    </x-input.file-upload>
                </div>
            </div>


        </div>

        <div class="mt-8 border-t border-gray-200 pt-5">
            <div class="space-x-3 flex justify-end items-center">
                <span x-data="{ open: false }" x-init="
                        @this.on('notify-saved', () => {
                            if (open === false) setTimeout(() => { open = false }, 2500);
                            open = true;
                        })
                    " x-show.transition.out.duration.1000ms="open" style="display: none;"
                    class="text-gray-500">{{__('Saved!')}}</span>

                <span class="inline-flex rounded-md shadow-sm">
                    <button type="button"
                        class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        {{__('Cancel')}}
                    </button>
                </span>

                <span class="inline-flex rounded-md shadow-sm">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                        {{__('Save')}}
                    </button>
                </span>
            </div>
        </div>
    </form>
</div>
