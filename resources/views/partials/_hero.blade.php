<section
class="relative h-80 bg-laravel flex flex-col justify-center align-center text-center mb-4"
>
<div
    class="absolute m-0 top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
    style="background-image: url('images/madv.jpg')"
></div>

<div class="z-10">
    <h1 class="text-6xl font-bold uppercase text-white">
        QUASI<span class="text-black">MOTO</span>
    </h1>
    <p class="text-2xl text-black-200 font-bold my-4">
        Still back in the game like Jack LaLanne
    </p>
    <div>
        @auth
        <a
            href="/listings/create"
            class="inline-block border-2 border-black text-black py-2 px-4 rounded-xl uppercase mt-2 hover:text-laravel hover:bg-black"
            >List an album</a
        >
        @else
        <a
            href="/register"
            class="inline-block border-2 border-black text-black py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black"
            >Sign Up to List an album</a
        >
        @endauth
    </div>
</div>
</section>