@props(['tagscsv'])
@php
    $tags = explode(',',$tagscsv);
@endphp

<ul class="flex">
    @foreach($tags as $tag)
        <li
            class="flex items-center justify-center bg-laravel text-black rounded-xl py-1 px-3 mr-2 text-xs"
        >
            <a href="/?tag={{$tag}}">{{$tag}}</a>
        </li>
    @endforeach
</ul>