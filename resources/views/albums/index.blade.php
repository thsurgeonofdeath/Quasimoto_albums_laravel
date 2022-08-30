<x-layout>

@include('partials._hero')
@include('partials._search')


<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
    @unless(count($albums)==0)

    @foreach($albums as $album)
    <x-listing-card :album="$album"/>
    @endforeach

    @else
    <p>No Albums availables </p>
    @endunless
</div>

<div class="mt-6 p-4">
    {{$albums->links()}}
</div>

</x-layout>


