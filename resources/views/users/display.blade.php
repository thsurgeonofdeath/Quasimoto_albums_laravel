<x-layout>
    {{-- <div class="flex content-center flex-col items-center gap-0">
        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="100" height="100" viewBox="0 0 10 10" xmlns:xlink="http://www.w3.org/1999/xlink">
            <img src="{{asset('images/buggysama.png')}}" alt="lol" class="h-56 w-64">
        </svg>
        <p>
            Hello {{$user->name}}, Buggy The Clown Here, this is a temporary profile page, will do more work on it soon
        </p><br/>
        <p>
            Edit you profile <b><a href="/users/edit">here</a></b>
        </p>
    </div> --}}
    <div class="container mx-auto my-5 p-5">
        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-white p-3 border-t-4 border-laravel">
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto"
                            src="{{$user->picture? asset('storage/'.$user->picture) : asset('/images/quasimo.jpg')}}"
                            alt="">
                    </div>
                    
                    <div class="flex justify-between">
                        <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{$user->name}}</h1>
                        <a href="/users/edit" class="mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                              </svg>
                        </a>
                    </div>
                    <h3 class="text-gray-600 font-lg text-semibold leading-6"> Quasimoto music {{$user->role}}</h3>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>Member since</span>
                            <span class="ml-auto">{{$created_at}}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 h-64">
                <!-- Profile tab -->
                <div class="my-4"></div>
                <!-- Experience and education -->
                <div class="bg-white p-3 shadow-sm rounded-sm">

                    <div class="grid grid-cols-2">
                        <div>
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                      </svg>
                                </span>
                                <span class="tracking-wide"> Latest reviews :</span>
                            </div>
                            @unless($reviews->isEmpty())
                            <ul class="list-inside space-y-2">
                                @foreach($reviews as $review)
                                @php
                                    $album = DB::table('albums')->where('id', $review->album_id)->first();
                                @endphp
                                <li>
                                    <div class="text-teal-600"><a href="/album/{{$review->album_id}}">{{$album->title}}</a></div>
                                    <div class="text-gray-500 text-xs">{{$album->artist}}</div>
                                    <div class="text-gray-500 text-xs">{{$review->created_at}}</div>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div>
                                <p class="px-5 py-5 italic">Nothing to display</p>
                            </div>
                        @endunless
                        </div>
                        <div>
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">Recent Likes :</span>
                            </div>
                            @unless($likedAlbums->isEmpty())
                            <ul class="list-inside space-y-2">
                                @foreach ($likedAlbums as $likedAlbum)
                                <li>
                                    <div class="text-teal-600"><a href="/album/{{$likedAlbum->id}}">{{$likedAlbum->title}}</a></div>
                                    <div class="text-gray-500 text-xs">{{$likedAlbum->artist}}</div>
                                </li>
                                @endforeach
                            </ul>
                            @else
                                <div>
                                    <p class="px-5 py-5 italic">Nothing to display</p>
                                </div>
                            @endunless
                        </div>
                    </div>
                    <!-- End of Experience and education grid -->
                </div>
                <!-- End of profile tab -->
            </div>
        </div>
    </div>
</div>
</x-layout>

