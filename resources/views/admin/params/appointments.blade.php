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

    <div class="p-6 sm:p-8">
        <div class="bg-white shadow p-6 max-w-6xl mx-auto">
            <livewire:admin.params.appointment-params />
        </div>
    </div>
</x-admin-layout>
