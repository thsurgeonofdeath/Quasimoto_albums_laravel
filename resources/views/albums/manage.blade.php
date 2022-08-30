<x-layout>
    <x-card class="p-10">
        <header class="mb-10">
            <h2
                class="text-3xl text-center font-mono my-6"
            >
                Manage Albums
            </h2>
        </header>

        <table class="items-center w-full bg-transparent border-collapse">
            @unless($albums->isEmpty()) 
            <thead class="text-left text-black bg-laravel">
                <tr>
                    <th class="px-6 align-middle py-3 uppercase font-semibold">Album</th>
                    <th class="px-6 align-middle py-3 uppercase font-semibold">Artist</th>
                    <th class="px-6 align-middle py-3 uppercase font-semibold">Operation</th>
                </tr>
            </thead>
    
            <tbody>
                @foreach($albums as $album)
                <tr>
                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4 text-left flex items-center">
                    <img src="{{$album->logo? asset('storage/'.$album->logo) : asset('/images/noalbum.png')}}" class="h-16 w-16" alt="...">
                    <span class="ml-3 font-semibold font-mono text-black"> {{$album->title}} </span></th>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 font-mono whitespace-nowrap p-4">{{$album->artist}}</td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                    <div class="flex items-center gap-8">
                        <a href="/albums/{{$album->id}}/edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="#7DDF00">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <form action="/albums/{{$album->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="albumID" value="{{$album->id}}">
                            <div class="flex gap-8">
                                <button onclick="return confirm('Are you sure you want to delete this album?');"  type="submit">
                                    <div class="w-4 mr-2 transform hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#FF847C" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>                                    
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </td>
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