<x-layout>
    <x-card class="p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                favourite albums
            </h1>
        </header>


        @unless($albums->isEmpty())
        <table class="w-full table-auto rounded-sm">
            <thead class="border-gray-300">
                <tr class="border-gray-300">
                    <td class=" border-t border-b border-gray-300 text-lg">
                        
                    </td>
                    <td class=" px-1 py-1 border-t border-b border-gray-300 text-lg">
                        Album name
                    </td>
                    <td class=" px-1 py-1 border-t border-b border-gray-300 text-lg">
                        Artist name
                    </td>
                    <td class=" px-1 py-1 border-t border-b border-gray-300 text-lg">
                        Realease date
                    </td>
                </tr>
            </thead>
        @foreach($albums as $album)
            <tbody>
                <tr class="border-gray-300">
                    <td class="px-1 py-2 border-t border-b border-gray-300 text-lg">
                        <a href="/album/{{$album->id}}"><img
                            class="w-32"
                            src="{{$album->logo? asset('storage/'.$album->logo) : asset('/images/noalbum.png')}}"
                            alt=""
                        /></a>
                    </td>
                    <td
                        class="px-1 py-2 border-t border-b border-gray-300 text-lg hover:text-laravel"
                    >
                        <a href="/album/{{$album->id}}">
                           {{ $album->title}}
                        </a>
                    </td>
                    <td
                        class="px-1 py-2 border-t border-b border-gray-300 text-lg"
                    >
                        <a href="#">
                           {{ $album->artist}}
                        </a>
                    </td> 
                    <td
                        class="px-1 py-2 border-t border-b border-gray-300 text-lg"
                    >
                        <a href="#">
                           {{ $album->year}}
                        </a>
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
    </x-card>
</x-layout>