<x-dashboard-bar>
    <table class="min-w-max w-full">
        <thead>
            <tr class="bg-gradient-to-r from-laravel to-yellow-500 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left auto-cols-min">User</th>
                <th class="py-3 px-6 text-left">Message</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($messages as $message)
            @php
                $sender = DB::table('users')->where('id', $message->user_id)->first();
            @endphp
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">
                    <div class="flex items-center">
                        <div class="mr-2">
                            <img class="w-6 h-6 rounded-full" src="{{$sender->picture? asset('storage/'.$sender->picture) : asset('/images/quasimo.jpg')}}"/>
                        </div>
                        <span>{{$sender->name}}</span>
                    </div>
                </td>
                <td class="py-3 px-6 text-left whitespace-nowrap ">
                    <div class="flex items-center font-medium">
                        {{$message->message}}
                    </div>
                </td>
                <td class="py-3 px-6 text-center">
                    <form action="/deleteMessage/{{$message->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure you want to delete this message?');"  type="submit">
                            <div class="w-4 mr-2 transform hover:text-laravel hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-dashboard-bar>