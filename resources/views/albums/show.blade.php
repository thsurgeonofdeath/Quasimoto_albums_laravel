<x-layout>

@include('partials._search')


<a href="/" class="inline-block text-black ml-4 mb-4"
><i class="fa-solid fa-arrow-left"></i> Back
</a>
<div class="mx-4">
    <x-card class="p-10">
        <div class="flex flex-col">
            <div class=" p-8 flex gap-10 mb-0">
                <div>
                    <img
                        class="w-80 mr-6 mb-6"
                        src="{{$album->logo? asset('storage/'.$album->logo) : asset('/images/noalbum.png')}}"
                        alt=""
                    />
                </div>
                <div>
                    <div class="text-2xl text-black font-semibold mb-4">
                        {{$album->title}}
                    </div>
                    <table>
                        <tr class="h-10">
                            <td class="w-24 text-gray-400">
                                Artist
                            </td>
                            <td  class="font-bold mb-4 font-serif">
                                <a href="/?artist={{$album->artist}}">{{$album->artist}}</a>
                            </td>
                        </tr>
                        <tr class="h-10">
                            <td class="w-24 text-gray-400">
                                Type
                            </td>
                            <td  class="font-bold mb-4 font-serif">
                                {{$album->type}}
                            </td>
                        </tr>
                        <tr class="h-10">
                            <td class="text-gray-400">
                                Genres
                            </td>
                            <td>
                                <x-insidetags :tagscsv="$album->tags"/>
                            </td>
                        </tr>
                        <tr class="h-10">
                            <td class="w-24 text-gray-400">
                                Label
                            </td>
                            <td  class="font-bold mb-4 font-serif">
                                {{$album->label}}
                            </td>
                        </tr>
                        <tr class="h-10">
                            <td class="text-gray-400">
                                Rating
                            </td>
                            <td  class="font-sans text-gray-600">
                                @if($rating != null)
                                <span class="font-bold mb-4 text-black font-mono">{{$rating}}</span>/5 from <span class="font-semibold text-gray-800">{{$ratingCount}}</span> ratings
                                @else
                                No ratings yet
                                @endif
                            </td>
                        </tr>
                        <tr class="h-10">
                            <td class="text-gray-400">
                                Article By
                            </td>
                            <td>
                                <div class="flex items-center">
                                    <span><a href="/users/display/{{$writer->id}}">{{$writer->name}}</a></span>
                                </div>
                            </td>
                        </tr>
                        <tr class="h-10">
                            <td>                                         
                                <a href="{!!Share::currentPage('Checkout this album on my personal website :')->twitter()->getRawlinks();!!}" class="bg-blue-500 hover:bg-laravel hover:text-black text-white text-xs py-1 px-4 rounded-full" target="_blank">
                                    <i class="fa-brands fa-twitter"></i> Tweet
                                </a>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
            <div> 
                <div class="flex px-10">
                    <div class=" text-lg shadow-2xl text-left flex-1 h-fit p-5">
                        <h3 class="font-bold">Tracklist :</h3>
                        @foreach($tracks as $track)
                           <p>{{$loop->index + 1}}. {{$track}}</p>
                        @endforeach                       
                    </div>
                    <div class="text-lg ml-10 flex-[4_1_0%]">
                        <div class="text-left mb-10 " style="white-space: pre-line">
                            {{$album->description}}
                        </div>
                    </div>
            </div>
            
            <div class="text-center justify-center"> 
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
<div class="mx-8 mt-4">
    @if(!$reviews->isEmpty())
    <h2 class="font-bold mb-8">USER REVIEWS :</h3>
        @foreach($reviews as $comment)
            @php
            $ReviewUserCollection =  DB::table('users')->where('id', $comment->user_id)->get();
            $ReviewUser = $ReviewUserCollection[0];
            @endphp
            <div class="relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg">
                <div class="relative flex gap-4">
                    @if ($ReviewUser->isBlocked)
                    <img src="{{asset('/images/blocked.jpg')}}" class="relative rounded-lg -top-8 -mb-4 bg-white border h-20 w-20" alt="" loading="lazy">
                    <div class="flex flex-col w-full">
                        <div class="flex flex-row justify-between">
                            <p class="relative text-xl whitespace-nowrap truncate overflow-hidden">Blocked User</p>
                    @else
                    <a href="/users/display/{{$ReviewUser->id}}">
                    <img src="{{$ReviewUser->picture? asset('storage/'.$ReviewUser->picture) : asset('/images/quasimoto.jpg')}}" class="relative rounded-lg -top-8 -mb-4 bg-white border h-20 w-22" alt="" loading="lazy">
                    </a>
                    <div class="flex flex-col w-full">
                        <div class="flex flex-row justify-between">
                            <div class="flex gap-4">
                            <a href="/users/display/{{$ReviewUser->id}}"><p class="relative text-xl whitespace-nowrap truncate overflow-hidden">{{$ReviewUser->name}}</p></a>
                                @if(!is_null($comment->rating))
                                @php
                                @endphp
                                <ul class="flex justify-center mt-2">
                                
                                {!! str_repeat('<li>
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" class="w-4 text-yellow-500 mr-0" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path>
                                  </svg></li>', $comment->rating) !!}
                                {!! str_repeat('
                                <li>
                                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="star" class="w-4 text-yellow-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                      <path fill="currentColor" d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path>
                                    </svg>
                                  </li>', 5 - $comment->rating) !!}
                                </ul>
                                @endif
                            </div>
                    @endif
                            @if($checkadmin == true)
                            <form action="/deleteReview/{{$comment->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                            <button class="text-gray-500 text-xl" type="submit"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            @endif
                        </div>
                        <p class="text-gray-400 text-sm">{{$comment->created_at}}</p>
                    </div>   
                </div>

                
                <p class="-mt-4 text-gray-500">{{$comment->review}}</p>
            </div>

        @endforeach

    @endif
        <br>
        <br>
            @php
            $CurrentUserID =  auth()->user()->id;
            $ReviewToken = DB::table('reviews')->where('user_id',$CurrentUserID)->where('album_id',$album->id)->get();
            @endphp

        @if($ReviewToken->isEmpty())   
        <form method="POST" action="/addReview">
            @csrf
            <label class="block mb-2 text-sm font-medium text-black">Add your review</label>  
            <textarea name="review" rows="4" class="block p-2.5 w-full text-sm text-black-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Your review..."></textarea>
            <input name="album_id" type="hidden" value="{{$album->id}}">
            @error('review')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="flex gap-16 mt-2">
                <div class="rateyo" id="rateyo"
                data-rateyo-rating="0"
                data-rateyo-num-stars="5"
                data-rateyo-star-width="20px"
                data-rateyo-full-star="true">
            </div>       
            </div> 
            <input type="hidden" id ="rating" name="rating" value="document.getElementbyId('result').value">
            <br>
            <button type="submit" class="focus:outline-none text-black bg-laravel hover:bg-black hover:text-laravel font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2">submit</button>
        </form>
        @else
        @php
        $CurrentUserReview = $ReviewToken->first()->review;
        $CurrentUserRating = $ReviewToken->first()->rating;
        $CurrentUserReviewID = $ReviewToken->first()->id;
        @endphp
        <form method="POST" action="/editReview/{{$CurrentUserReviewID}}">
            @csrf
            @method('PUT')
            <label class="block mb-2 text-sm font-medium text-black">Edit your review</label>
            <textarea name="review" rows="4" class="block p-2.5 w-full text-sm text-black-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Your review..." >{{$CurrentUserReview}}</textarea>
            @error('review')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <div class="flex gap-16 mt-2">
                <div class="EditRateyo"
                data-rateyo-rating="{{$CurrentUserRating}}"
                data-rateyo-num-stars="5"
                data-rateyo-star-width="20px"
                data-rateyo-full-star="true">
            </div>       
            </div> 
            <input type="hidden" id ="editRating" name="editRating" value="{{$CurrentUserRating}}">
            <button type="submit" name="action" value="update" class="focus:outline-none text-black bg-laravel hover:bg-black hover:text-laravel font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2">save changes</button>
            <button type="submit" name="action" value="delete" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 mt-2">delete review</button>
        </form>
        @endif
</div>
</x-layout>