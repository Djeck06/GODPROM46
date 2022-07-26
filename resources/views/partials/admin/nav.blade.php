<x-common.nav-link :href="route('admin.home')" :active="request()->routeIs('admin.home')">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
    </svg>
    Tableau de bord
</x-common.nav-link>

<x-common.nav-link :href="route('admin.customers')" :active="request()->routeIs('admin.customers')">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
    </svg>
    Clients
</x-common.nav-link>

<x-common.nav-link :href="route('admin.carriers')" :active="request()->routeIs('admin.carriers')">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
    </svg>
    Transporteurs
</x-common.nav-link>




<x-common.nav-dropdown :active="request()->routeIs('admin.orders.*')">
    <x-slot name="title">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
        </svg>
        Commandes
    </x-slot>

    <x-common.nav-link  :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.index')">
   
    Tout
    </x-common.nav-link>

    <x-common.nav-link  :href="route('admin.orders.status',['status'=> 'readytopickup'])" :active="request()->routeIs('admin.orders.status')" >
        
    Pret pour l'enlevement
    </x-common.nav-link>


    <x-common.nav-link :href="route('admin.orders.status',['status'=> 'pending'])" :active="request()->routeIs('admin.orders.status')">
        
    pending
    </x-common.nav-link>
    




</x-common.nav-dropdown>




<x-common.nav-dropdown :active="request()->routeIs('admin.docks.*')">
    <x-slot name="title">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" />
        </svg>
        Quai
    </x-slot>

    <x-common.nav-link  :href="route('admin.docks.packagings.status',['status'=> 'pending'])" :active="request()->routeIs('admin.commandassigns')">
   
    assignation
    </x-common.nav-link>

    <x-common.nav-link :href="route('admin.docks.deposits.index')" :active="request()->routeIs('admin.docks.deposits.index')">
        
    reception
    </x-common.nav-link>

    <x-common.nav-link :href="route('admin.docks.packagings.status',['status'=> 'pending'])" :active="request()->routeIs('admin.docks.packagings.status')">
        
    attente
    </x-common.nav-link>

    <x-common.nav-link :href="route('admin.docks.packagings.index')" :active="request()->routeIs('admin.docks.packagings.index')">
        
    recondition
    </x-common.nav-link>

 



</x-common.nav-dropdown>



<x-common.nav-link :href="route('admin.params.appointments')" :active="request()->routeIs('admin.params.appointments')">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
    </svg>
    Plages de RDV
</x-common.nav-link>


<span class="block py-2 pl-6 bg-blue-100 text-xs font-light text-gray-800 my-3">Livraison</span>
<x-common.nav-link :href="route('admin.boxes')" :active="request()->routeIs('admin.boxes')">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
    </svg>
    Contenaires
</x-common.nav-link>
<x-common.nav-link :href="route('admin.fencing')" :active="request()->routeIs('admin.fencing')">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
    </svg>
    Clôture
</x-common.nav-link>


<span class="block py-2 pl-6 bg-blue-100 text-xs font-light text-gray-800 my-3">Statistiques</span>
<x-common.nav-link href="#">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
    </svg>
    Statistiques Générales
</x-common.nav-link>

<x-common.nav-link href="#">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
    </svg>
    Statistiques Détaillées
</x-common.nav-link>

<span class="block py-2 pl-6 bg-blue-100 text-xs font-light text-gray-800 my-3">Administration</span>

<x-common.nav-dropdown :active="request()->routeIs('admin.users.*')">

    <x-slot name="title">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg> Utilisateurs
    </x-slot>

    <x-common.nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
        Utilisateurs
    </x-common.nav-link>

    <x-common.nav-link href="#">
        Droits & Permissions
    </x-common.nav-link>

</x-common.nav-dropdown>

<x-common.nav-dropdown :active="request()->routeIs('admin.params.*')">
    <x-slot name="title">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg> Paramètres
    </x-slot>

    <x-common.nav-link :href="route('admin.params.countries')" :active="request()->routeIs('admin.params.countries')">
        Pays
    </x-common.nav-link>

    <x-common.nav-link :href="route('admin.params.prices')" :active="request()->routeIs('admin.params.prices')">
        Prix
    </x-common.nav-link>

    <x-common.nav-link :href="route('admin.params.packages')" :active="request()->routeIs('admin.params.packages')">
        Packages
    </x-common.nav-link>



</x-common.nav-dropdown>
