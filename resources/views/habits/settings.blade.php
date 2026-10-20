<x-layout>
    <main class="py-10 min-h-[calc(100vh-140px)] px-4">

        <x-navbar/>

        @session('success')
        <div class="flex">
            <p class="bg-green-100 border border-green-400 text-green-700 p-3 mb-4">
                {{ session('success') }}
            </p>
        </div>
        @endsession

        <div>
            <h2 class="text-lg mt-8 mb-2">
              Configurar Hábitos
            </h2>

            <ul class="flex flex-col gap-2">
                @forelse ($habits as $item )
                <li class="habit-shadow-lg p-2 bg-[#90C1F0]">
                    <div class="flex gap-2 items-center">
                        <p class="font-bold text-lg">
                          {{ $item->name }}
                        </p>
                        <a href="{{ route('habits.edit', $item->id)}}" class="bg-white p-1 hover:opacity-50">
                          <x-icons.edit />
                        </a>

                        <form action="{{ route('habits.destroy', $item) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="bg-red-400 text-white p-1 hover:opacity-50 cursor-pointer">
                            <x-icons.trash />
                          </button>
                        </form>
                    </div>
                </li>

                @empty
                <p>
                    Ainda não temos hábitos cadastrados
                </p>
                <a class="bg-white p-2 border-2" href="{{ route('habits.create') }}">
                    Cadastrar novo hábito
                </a>
                @endforelse
            </ul>
        </div>
    </main>
</x-layout>
