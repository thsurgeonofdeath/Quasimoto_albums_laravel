<x-dashboard-bar>
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded text-black">
            <table class="items-center w-full bg-transparent border-collapse">
            <thead class="text-left bg-zinc-500 text-laravel">
                <tr>
                    <th class="px-6 align-middle py-3 text-xs uppercase font-semibold">Album</th>
                    <th class="px-6 align-middle py-3 text-xs uppercase font-semibold">Artist</th>
                    <th class="px-6 align-middle py-3 text-xs uppercase font-semibold">Writer</th>
                    <th class="px-6 align-middle py-3 text-xs uppercase font-semibold">Details</th>
                    <th class="px-6 align-middle py-3 text-xs uppercase font-semibold">Operation</th>
                </tr>
            </thead>
    
            <tbody>
                @foreach($pendingAlbums as $album)
                    @php
                        $writer = DB::table('users')->where('id', $album->user_id)->first(); 
                    @endphp
                <tr>
                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                    <img src="{{$album->logo? asset('storage/'.$album->logo) : asset('/images/noalbum.png')}}" class="h-12 w-12 border border-black" alt="...">
                    <span class="ml-3 font-bold text-black"> {{$album->title}} </span></th>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{$album->artist}}</td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    <div class="flex items-center">
                        <div class="mr-2">
                            <img class="w-10 h-10 rounded-full" src="{{$writer->picture? asset('storage/'.$writer->picture) : asset('/images/quasimo.jpg')}}"/>
                        </div>
                        <span>{{$writer->name}}</span>
                    </div>
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    <form action="/dashboard/details/{{$album->id}}" method="GET">
                        <button class="bg-zinc-500 hover:bg-laravel hover:text-zinc-500 text-laravel font-bold py-2 px-4 rounded inline-flex items-center" data-modal-toggle="defaultModal">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                            </svg>                          
                            <span>Details</span>                        
                        </button>
                    </form>
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><div class="flex items-center">
                    <form action="/approve/{{$album->id}}" method="POST">
                        @csrf
                        <input type="hidden" name="albumID" value="{{$album->id}}">
                        <div class="flex gap-8">
                            <button name="action" value="approve" onclick="return confirm('Are you sure you want to approve this album?');"  type="submit">
                                <div class="w-4 mr-2 transform hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="lime" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                                    </svg>   
                                </div>
                            </button>
                            <button name="action" value="delete" onclick="return confirm('Are you sure you want to delete this album?');"  type="submit">
                                <div class="w-4 mr-2 transform hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#D8564E" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>                                    
                                </div>
                            </button>
                        </div>
                    </form>
                </td>
                @endforeach
            </tbody>
            </table>
    </div>
</x-dashboard-bar>