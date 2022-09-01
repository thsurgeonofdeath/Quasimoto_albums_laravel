<x-dashboard-bar>
    <div class="p-8 flex gap-10 mb-0">
        <div>
            <img
                class="w-80 mr-6 mb-6"
                src="{{$album->logo? asset('storage/'.$album->logo) : asset('/images/noalbum.png')}}"
                alt=""
            />
        </div>
        <div>
            <div class="mb-2 text-lg font-semibold">{{$album->title}}</div>
            <div class="mb-4 text-base text-black">Artist : <span class="font-semibold">{{$album->artist}}</span></div>
            <div class="mb-4 text-base text-black mt-2">Released : {{$album->year}}</div>
            <div> <p class="mb-2 text-base text-black mt-2">Genres:</p> <x-insidetags :tagscsv="$album->tags"/></div>
            <div class="mb-4 text-base text-black mt-2">Label : {{$album->label}}</div>
            <div class="mb-4 text-base text-black mt-2">RateYourMusic Page : <a href="{{$album->website}}" class="font-semibold">{{$album->title}}</a></div>
            <div class="mb-4 text-base text-black">
                Submitted by: <br>
                <div class="flex items-center">
                    <div class="mr-2">
                        <img class="w-8 h-8 rounded-full" src="{{$writer->picture? asset('storage/'.$writer->picture) : asset('/images/quasimoto.jpg')}}"/>
                    </div>
                    <span><a href="/users/display/{{$writer->id}}">{{$writer->name}}</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-8"> 
        <div class="flex px-10">
            <div class=" text-lg shadow-2xl text-left flex-1 h-fit">
                <table class=" w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-laravel to-yellow-500 text-sm text-center">
                            <th class="p-2">tracklist</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach($tracks as $track)
                        <tr>
                            <td class="p-1">{{$loop->index + 1}}. {{$track}}</td>
                        </tr>
                        @endforeach 
                    </tr>
                    </tbody>
                </table>
                                      
            </div>
            <div class="text-base ml-10 flex-[4_1_0%]">
                <div class="text-left" style="white-space: pre-line">
                    {{$album->description}}
                </div>
            </div>
    </div>
    <div class="mt-20 w-40 right-0">
        <form action="/approve/{{$album->id}}" method="POST">
            @csrf
            <input type="hidden" name="albumID" value="{{$album->id}}">
            <div class="flex gap-2">
                <button name="action" value="approve" onclick="return confirm('Are you sure you want to approve this album?');"  type="submit" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
                    Approve
                </button>
                <button name="action" value="delete" onclick="return confirm('Are you sure you want to delete this message?');"  type="submit" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                    delete
                </button>
            </div>
        </form>
    </div>
</x-dashboard-bar>