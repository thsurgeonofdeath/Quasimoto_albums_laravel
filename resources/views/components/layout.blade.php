<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#DEDE4C",
                            sprite: "#4EBDA8",
                            ssprite: "#458A7D"
                        },
                    },
                },
            };
        </script>
        <title>All Caps</title>
        @livewireStyles
    </head>
    <body class="mb-48">
        <nav class="flex justify-between items-center mb-0 pb-1">
            <a href="/"
                ><img class="w-36" src="{{asset('images/lordquas.png')}}" alt="" class="logo"
            /></a>
            <ul class="flex space-x-6 mr-6 text-lg">
                @auth
                @if($checkadmin == true)
                <li>
                    <a href="/users/dashboard" class="hover:text-laravel"
                        ><i class="fa-solid fa-users"></i>
                        Manage Users</a
                    >
                </li>
                @endif
                <li>
                    <a href="/users/display" class="hover:text-laravel"
                        ><i class="fa-solid fa-user-tie"></i>
                        User Info</a
                    >
                </li>
                <li>
                    <a href="/users/likes" class="hover:text-laravel"
                        ><i class="fa-regular fa-face-grin-hearts"></i>
                        Favourites</a
                    >
                </li>
                @if($checkadminwriter == true)
                <li>
                    <a href="/albums/manage" class="hover:text-laravel"
                        ><i class="fa-solid fa-gear"></i>
                        Manage albums</a
                    >
                </li>
                @endif
                <li>
                    <form class="inline" method="post" action="/logout">
                        @csrf
                        <button type="submit" class="hover:text-laravel">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </li>
                @else
                <li>
                    <a href="/register" class="hover:text-laravel"
                        ><i class="fa-solid fa-user-plus"></i> Register</a
                    >
                </li>
                <li>
                    <a href="/login" class="hover:text-laravel"
                        ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Login</a
                    >
                </li>
                @endauth
            </ul>
        </nav>
    <main>
    {{-- VIEW --}}
    {{$slot}}
    <main>
    <footer
    class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
>

    <p class="ml-2 text-black"> Viktor Vaughn &copy; Doritos, Cheetos or Fritos </p>
    @auth
    @if($checkadminwriter == true)
    <a
        href="/albums/create"
        class="absolute border-2 border-black top-1/3 right-10 rounded-lg bg-laravel text-black py-2 px-5 hover:text-laravel hover:bg-black"
        >Add Album</a
    >
    @endif
    @endauth
</footer>
<x-flashAlert/>
@livewireScripts
</body>
</html>