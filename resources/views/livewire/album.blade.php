<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$album->logo? asset('storage/'.$album->logo) : asset('/images/noalbum.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/album/{{$album->id}}">{{$album->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$album->artist}}</div>
            <x-tags :tagscsv="$album->tags"/>
            <div class="text-lg mt-4 font-serif">
                <i class="fa-solid fa-calendar-days"></i>   Release date: <a class="hover:text-laravel" href="/?date={{$album->year}}"> {{$album->year}}
            </div>
            @php
            $label = $album->label;
            @endphp
            <div class="flex text-lg mt-4 font-serif">
                <i class="fa-solid fa-compact-disc"></i>  <a class="hover:text-laravel" href="/?label={{$label}}">  Label: {{$label}}</a> 
            </div>         
        </div>    
    </div>
    @auth
    <div style="text-align: right; left:0; margin-right: 2">
        <button wire:click="addLike">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white-600" fill="{{$album->isLiked() ? 'red':'white'}}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </button>
    </div>
    @endauth
</div>

