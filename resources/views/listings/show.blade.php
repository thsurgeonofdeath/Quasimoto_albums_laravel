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
                src="{{$listing->logo? asset('storage/'.$listing->logo) : asset('/images/noalbum.png')}}"
                alt=""
            />

            <h3 class="text-2xl mb-2">{{$listing->title}}</h3>
            <div class="text-xl font-bold mb-4">{{$listing->artist}}</div>
            <x-tags :tagscsv="$listing->tags"/>
            <div class="text-lg my-4">
                <i class="fa-solid fa-record-vinyl"></i> Label: {{$listing->label}}
            </div>
            <div class="border border-gray-200 w-full mb-6"></div>
            <div>
                <h3 class="text-3xl font-bold mb-4">
                    About the album
                </h3>
                <div class="text-lg space-y-6">
                    <p>
                        {{$listing->description}}
                    </p>

                    {{-- <a
                        href="mailto:{{$listing->email}}"
                        class="block bg-laravel text-black mt-6 py-2 rounded-xl hover:opacity-80"
                        ><i class="fa-solid fa-envelope"></i>
                        Contact Employer</a
                    > --}}

                    <a
                        href="{{$listing->website}}"
                        target="_blank"
                        class="block bg-black text-laravel py-2 rounded-xl hover:opacity-80"
                        ><i class="fa-solid fa-globe"></i> Visit RateYourMusic page</a
                    >
                </div>
            </div>
        </div>
    </x-card>
</div>

</x-layout>