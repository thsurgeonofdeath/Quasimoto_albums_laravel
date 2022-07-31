<x-layout>
    <x-card class="p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Manage Albums
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($albums->isEmpty())
                @foreach($albums as $album)
                <tr class="border-gray-300">
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <a href="/album/{{$album->id}}">
                           {{ $album->title}}
                        </a>
                    </td>
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <a
                            href="/albums/{{$album->id}}/edit"
                            class="text-blue-400 px-6 py-2 rounded-xl"
                            ><i
                                class="fa-solid fa-pen-to-square"
                            ></i>
                            Edit</a
                        >
                    </td>
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                    <form method="POST" action="/albums/{{$album->id}}" >
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500"><i class="fa-solid fa-trash-can"></i> Delete</button>
                      </form>
                    </td>
                </tr>
             @endforeach
            </tbody>
        </table>
        @else
        <div class="flex justify-center">
            <div class="px-4 py-8 text-lg">
                <p class="text-center px-5 py-5 italic">No albums to display</p>
            </div>
        </div>
        @endunless
        <script>
            function albumDelete() {
            return confirm("Are you sure you want to delete this album?");
            }
        </script>
    </x-card>
</x-layout>