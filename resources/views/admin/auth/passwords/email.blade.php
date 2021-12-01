<x-auth-layout>
    <p class="text-center text-3xl">Réinitialiser un mot de passe!.</p>

    <form class="flex flex-col pt-3 md:pt-8" method="POST" action="{{ route('admin.password.email') }}">

        <x-auth-validation-errors class="bg-red-100 mb-4 p-4 rounded" :errors="$errors" />

        @csrf

        <div class="flex flex-col pt-4">
            <label for="email" class="text-lg">Email</label>
            <input type="email" id="email" name="email" placeholder="xxxx@xxx.com" value="{{ old('email') }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                autofocus
                required>
        </div>

        <button type="submit"
            class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">Envoyer le mail de réinitialisation</button>
    </form>
</x-auth-layout>
