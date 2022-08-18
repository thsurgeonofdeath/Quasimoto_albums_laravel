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
                           <p>{{$loop->index + 1}}. {{$track}}</p>
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
<div class="mx-8 mt-4">
    <h2 class="font-bold">USER REVIEWS :</h3>
        @foreach($reviews as $comment)
            @php
            $ReviewUser =  DB::table('users')->where('id', $comment->user_id)->get();
            @endphp
            <p><b> {{$ReviewUser[0]->name}}</b> : {{$comment->review}}  </p>
        @endforeach
        <br>
        <br>
        <form method="POST" action="/addReview">
            @csrf
            <label class="block mb-2 text-sm font-medium text-black">Add your review</label>
            <textarea name="review" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your review..."></textarea>
            <input name="album_id" type="hidden" value="{{$album->id}}">
            @error('review')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <button type="submit" class="focus:outline-none text-black bg-laravel hover:bg-black hover:text-laravel font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2">submit</button>
        </form>
</div>



</x-layout>