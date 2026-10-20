<x-layout>
    <main class="py-19">
        <h1>
            Veja seus hábitos ganharem vida
        </h1>

        @auth
            Bem vindo(a), {{ auth()->user()->name }}!
        @endauth

    </main>
</x-layout>
