<x-layout>

@include('partials._search')


<a href="/" class="inline-block text-black ml-4 mb-4"
><i class="fa-solid fa-arrow-left"></i> Back
</a>
<div class="mx-4">
    <x-card class="p-10">
        <div
            class="flex flex-col items-center justify-center text-center"
        >
            <img
                class="w-72 mr-6 mb-6"
                src="{{$album->logo? asset('storage/'.$album->logo) : asset('/images/noalbum.png')}}"
                alt=""
            />

            <h3 class="text-2xl mb-2">{{$album->title}}</h3>
            <div class="text-xl font-bold mb-4">{{$album->artist}}</div>
            <x-insidetags :tagscsv="$album->tags"/>
            <div class=" w-full mb-6 mt-5">
                <h3 class="text-3xl font-bold">
                    About the album
                </h3>
            </div>
            <div> 
                <div class="flex px-10">
                    <div class=" text-lg shadow-2xl text-left flex-1 h-fit p-5">
                        <h3 class="font-bold">Tracklist :</h3>
                        @foreach($tracks as $track)
                            <p>- {{$track}}</p>
                        @endforeach
                    </div>
                    <div class="text-lg ml-10 flex-[4_1_0%]">
                        <div class="text-left py-10">
                            {{$album->description}}
                        </div>
                    </div>
            </div>
            
            <a
            href="{{$album->website}}"
            target="_blank"
            class=" bg-black text-laravel mt-16 py-2 px-10 rounded-xl hover:opacity-80"
            ><i class="fa-solid fa-globe"></i> Visit RateYourMusic page</a
            >
                
                
            </div>
        </div>
    </x-card>
</div>

</x-layout>