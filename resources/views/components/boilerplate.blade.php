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
    {{$slot}}
    @livewireScripts
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
</body>
</html>