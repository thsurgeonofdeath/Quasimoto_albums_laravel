<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">    
        <link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <style>
            /* rating */
        .rating-css div {
            color: #ffe400;
            font-size: 10px;
            font-family: sans-serif;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
            padding: 10px 0;
        }
        .rating-css input {
            display: none;
        }
        .rating-css input + label {
            font-size: 40px;
            text-shadow: 1px 1px 0 #8f8420;
            cursor: pointer;
        }
        .rating-css input:checked + label ~ label {
            color: #b4afaf;
        }
        .rating-css label:active {
            transform: scale(0.8);
            transition: 0.3s ease;
        }
        /* End of Star Rating */
        </style>
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
                    <a href="/users/display/{{auth()->user()->id}}" class="hover:text-laravel"
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
    <!-- ijaboCropTool.js plug -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <script>
        $('#_userProfileID').ijaboCropTool({
           preview : '.image-previewer',
           setRatio:1,
           allowedExtensions: ['jpg', 'jpeg','png','webp'],
           buttonsText:['CROP','QUIT'],
           buttonsColor:['#30bf7d','#ee5155', -15],
           processUrl:'{{ route("create.crop") }}',
           withCSRF:['_token','{{ csrf_token() }}'],
           onSuccess:function(message, element, status){
              alert(message);
              location.reload();
           },
           onError:function(message, element, status){
             alert(message);
           }
        });
    </script>
    {{-- Rateyo js file --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        $(function () {
            $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
                var rating = data.rating;
                document.getElementById('rating').value = rating;
            });
        });
        $(function () {
            $(".EditRateyo").rateYo().on("rateyo.change", function (e, data) {
                var rating = data.rating;
                document.getElementById('editRating').value = rating;
            });
        });
    </script>
</body>
</html>