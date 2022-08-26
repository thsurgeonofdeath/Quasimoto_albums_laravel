<x-dashboard-bar>
    <p class="font-bold m-4 text-red-800">Messages go here :</p> 
        <ol class="ml-6">
            @foreach($messages as $message)
            @php
                $sender = DB::table('users')->where('id', $message->user_id)->first();
            @endphp
            <ul>
                <b>{{$sender->name}} :</b> {{$message->message}}
            </ul>
            @endforeach
        </ol>
</x-dashboard-bar>