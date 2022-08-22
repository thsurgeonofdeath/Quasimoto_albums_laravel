<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="flex">
        <img
            class="w-48 h-48 mr-6 md:block"
            src="{{$album->logo? asset('storage/'.$album->logo) : asset('/images/noalbum.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/album/{{$album->id}}" class="hover:font-bold hover:text-laravel">{{$album->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4"><a class="hover:text-laravel" href="/?artist={{$album->artist}}">{{$album->artist}}</a></div>
            <x-tags :tagscsv="$album->tags"/>
            <div class="text-lg mt-4 font-serif">
                <i class="fa-solid fa-calendar-days mx-2"></i>Release date: <a class="hover:text-laravel" href="/?date={{$album->year}}"> {{$album->year}}</a>
            </div>
            @php
            $label = $album->label;
            @endphp
            <div class="flex text-lg mt-4 font-serif">
                <i class="fa-solid fa-compact-disc mt-1 mx-2"></i>Label:  <a class="hover:text-laravel" href="/?label={{$label}}"> {{$label}}</a> 
            </div>         
        </div>    
    </div>
    @auth
    <div style="text-align: right; left:0; margin-right: 2">
        @if($checkadmin == true)
        <button wire:click="editAlbum({{$album->id}})">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
              </svg>
        </button>
        @elseif($checkadminwriter== true && $album->user_id == $authenticatedUserID)
        <button wire:click="editAlbum({{$album->id}})">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
              </svg>
        </button>
        @endif
        <button wire:click="addLike">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white-600" fill="{{$album->isLiked() ? 'red':'white'}}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </button>
    </div>
    @endauth
</div>

