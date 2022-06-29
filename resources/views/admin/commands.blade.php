<x-admin-layout>
    <div class="bg-white border-b">
        <div class="flex flex-col w-full mx-auto px-6 sm:px-8">
            <div class="flex flex-col sm:flex-row flex-auto sm:items-center min-w-0 my-8 sm:my-12">
                <div class="flex flex-auto items-center min-w-0">
                    <div class="flex flex-col min-w-0">
                        <div class="text-4xl font-extrabold tracking-tight leading-none">
                            {{ $title }}!
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($etat))
    <livewire:admin.command-params :etat="$etat" :secondtitle="$secondtitle"  />
    @else
    <livewire:admin.command-params  />
    @endif

</x-admin-layout>
