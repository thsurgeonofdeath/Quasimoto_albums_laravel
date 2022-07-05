@props(['list'])

<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$list->logo? asset('storage/'.$list->logo) : asset('/images/noalbum.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listing/{{$list->id}}">{{$list->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$list->artist}}</div>
            <x-tags :tagscsv="$list->tags"/>
            <div class="text-lg mt-4 font-serif">
                <i class="fa-solid fa-calendar-days"></i>   Release date: <a class="hover:text-laravel" href="/?date={{$list->year}}"> {{$list->year}}
            </div>
            @php
            $label = $list->label;
            @endphp
            <div class="text-lg mt-4 font-serif">
                <i class="fa-solid fa-compact-disc"></i>   Label:<a class="hover:text-laravel" href="/?label={{$label}}">   {{$label}}</a> 
            </div>
        </div>
    </div>
</x-card>