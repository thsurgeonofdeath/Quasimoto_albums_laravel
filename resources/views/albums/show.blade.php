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
                class="w-48 mr-6 mb-6"
                src="{{$album->logo? asset('storage/'.$album->logo) : asset('/images/noalbum.png')}}"
                alt=""
            />

            <h3 class="text-2xl mb-2">{{$album->title}}</h3>
            <div class="text-xl font-bold mb-4">{{$album->artist}}</div>
            <x-insidetags :tagscsv="$album->tags"/>
            <div class="text-lg my-4">
                <i class="fa-solid fa-record-vinyl"></i> Label: {{$album->label}}
            </div>
            <div class="border border-gray-200 w-full mb-6"></div>
            <div>
                <h3 class="text-3xl font-bold mb-4">
                    About the album
                </h3>
                <div class="text-lg space-y-6">
                    <p class="text-justify px-40 py-10">
                        {{$album->description}}
                    </p>

                    {{-- <a
                        href="mailto:{{$listing->email}}"
                        class="block bg-laravel text-black mt-6 py-2 rounded-xl hover:opacity-80"
                        ><i class="fa-solid fa-envelope"></i>
                        Contact Employer</a
                    > --}}

                    <a
                        href="{{$album->website}}"
                        target="_blank"
                        class=" bg-black text-laravel mt-16 py-2 px-10 rounded-xl hover:opacity-80"
                        ><i class="fa-solid fa-globe"></i> Visit RateYourMusic page</a
                    >
                </div>
            </div>
        </div>
    </x-card>
</div>

</x-layout>