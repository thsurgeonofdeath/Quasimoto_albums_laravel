@props(['tagscsv'])
@php
    $tags = explode(',',$tagscsv);
    $counters = 0;
@endphp

<ul class="flex">
    @foreach($tags as $tag)
        @php
        $counters += 1; 
        @endphp
        @if($counters < 4)
        <li
            class="flex items-center justify-center bg-laravel text-black rounded-xl py-1 px-3 mr-2 text-xs"
        >
            <a href="/?tag={{$tag}}">{{$tag}}</a>
        </li>
        @else
            @break
        @endif
    @endforeach
</ul>