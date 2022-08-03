<x-guest>
    <div class="min-h-screen flex mt-0 flex-col m-0 items-center justify-center bg-gray-100">
        <div>
                <img src="{{asset('images/sadquas.png')}}" alt="quas" class="h-64"> 
        </div>

        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>

            <div class="mb-4 text-sm text-gray-600">
                {{ __('I get that this is confusing as you were expecting to login to your account, however, there is a small problem here, your account was suspended. haha, ooops') }}
            </div>
        </div>
    </div>
</x-guest>
