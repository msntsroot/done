<x-layout>
    <main class="py-10">
        <h1>
            Editar hábito
        </h1>

        <section class="bg-white max-w-150 mx-auto p-6 border-2 mt-4">
            <form action="{{ route('habits.update', $habit->id) }}" method="post" class="flex flex-col">
                @method('PUT')
                @csrf
                <div class="flex flex-col gap-2 mb-2">
                    <label for="email">
                        Nome do Hábito
                    </label>

                    <input
                    type="text"
                    name="name"
                    placeholder="Ler 10 páginas"
                    class="bg-white p-2 border-2"
                    value="{{ $habit->name }}"
                    @error('name') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <button type="submit" class="bg-white border-2 p-2">
                    Atualizar hábito
                </button>
            </form>
        </section>
    </main>
</x-layout>
