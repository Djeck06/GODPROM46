<div>
    <h1 class="text-2xl font-semibold text-gray-900">{{ __('My orders') }}</h1>

    <div class="py-4 space-y-4">
        <div class="flex justify-between">
            <div class="w-1/4 flex space-x-4">
                <x-input.text wire:model="filters.search" placeholder="Rechercher..." />
            </div>

            <div class="space-x-2 flex items-center">
                <x-input.group borderless paddingless for="perPage" label="Par Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>
            </div>
        </div>

        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable multi-column wire:click="sortBy('reference')"
                        :direction="$sorts['reference'] ?? null" class="">{{ __('Reference') }}</x-table.heading>
                    <x-table.heading>{{ __('pickup country') }}</x-table.heading>
                    <x-table.heading>{{ __('Delivery country') }}</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('price')"
                        :direction="$sorts['price'] ?? null" class="">{{ __('Price') }}</x-table.heading>
                    <x-table.heading>{{ __('Status') }}</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('created_at')"
                        :direction="$sorts['created_at'] ?? null" class="">{{ __('Date') }}</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @forelse ($orders as $order)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $order->id }}">

                            <x-table.cell>
                                <a href="{{ route('orders.show', $order->reference) }}" class="inline-flex space-x-2 truncate text-sm leading-5">
                                    {{ $order->reference }}
                                </a>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->pickupCountry->name }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->deliveryCountry->name }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->price }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->status }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->created_at->diffForHumans() }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex justify-center items-center">
                                    <a href="{{ route('orders.show', $order->reference) }}" class="text-cool-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-cool-gray-800 focus:underline transition duration-150 ease-in-out">{{ __('Details') }}</a>

                                </div>
                            </x-table.cell>


                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="6">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-xl">Aucun pays dans le
                                        système</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>

            </x-table>

            <div>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
