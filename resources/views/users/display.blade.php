<x-layout>
    <div class="flex content-center flex-col items-center gap-0">
        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="100" height="100" viewBox="0 0 10 10" xmlns:xlink="http://www.w3.org/1999/xlink">
            <img src="{{asset('images/buggysama.png')}}" alt="lol" class="h-56 w-64">
        </svg>
        <p>
            Hello {{$user->name}}, Buggy The Clown Here, this is a temporary profile page, will do more work on it soon
        </p><br/>
        <p>
            Edit you profile <b><a href="/users/edit">here</a></b>
        </p>
    </div>
</x-layout>