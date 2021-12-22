<x-auth-layout>
    <p class="text-center text-3xl">Connexion à l'administration!.</p>


    <form class="flex flex-col pt-3 md:pt-8" method="POST" action="{{ route('admin.login') }}">
        <x-auth-validation-errors class="bg-red-100 mb-4 p-4 rounded" :errors="$errors" />
        @csrf
        
        <div class="flex flex-col pt-4">
            <label for="email" class="text-lg">Email</label>
            <input type="email" id="email" name="email" placeholder="xxxx@xxx.com" value="{{ old('email') }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                autofocus
                required>
        </div>

        <div class="flex flex-col pt-4">
            <label for="password" class="text-lg">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>

        <div class="pt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border shadow focus:outline-none focus:shadow-outline" name="remember">
                <span class="ml-2 text-lg text-gray-700">Se souvenir de moi</span>
            </label>
        </div>

        <button type="submit"
            class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">Connexion</button>
    </form>
    <div class="text-center pt-12 pb-12">
        <a href="{{ route('admin.password.request') }}" class="underline font-semibold">Mot de passe oublié?</a>
    </div>
</x-auth-layout>
