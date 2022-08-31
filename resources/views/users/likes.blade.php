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
            @foreach($albums as $album)
            <x-listing-card :album="$album"/>
            @endforeach
        @else
        <div class="flex justify-center">
            <div class="px-4 py-8 text-lg">
                <p class="text-center px-5 py-5 italic">No albums to display</p>
            </div>
        </div>
        @endunless
    </x-card>
</x-layout>