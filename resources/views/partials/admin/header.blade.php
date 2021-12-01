<header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
    <div class="w-1/2"></div>
    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
        <button @click="isOpen = !isOpen"
            class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
            <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
        </button>
        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
        <div x-show="isOpen" class="absolute w-40 bg-white rounded-lg shadow-lg py-2 mt-16">
            <a href="#" class="block px-4 py-2 hover:bg-blue-400 hover:text-white">Mon Compte</a>
            <a href="#"
                class="block px-4 py-2 hover:bg-blue-400 hover:text-white">Support</a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <a href="#" class="block px-4 py-2 hover:bg-blue-400 hover:text-white"
                    onclick="event.preventDefault(); this.closest('form').submit();">Déconnexion</a>
            </form>
        </div>
    </div>
</header>

<header x-data="{ isOpen: false }" class="w-full bg-gray-800 py-5 px-6 sm:hidden">
    <div class="flex items-center justify-between">
        <a href="index.html"
            class="text-white text-3xl font-semibold uppercase hover:text-gray-300">{{ config('app.name', 'GodProm') }}</a>
        <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
            <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
        @include('partials.admin.nav')
    </nav>
    <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
</header>
