<x-layout>
<x-card class="p-10 max-w-lg mx-auto mt-24">
     <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
              Add an album
        </h2>
            <p class="mb-4">add the album details below</p>
     </header>
    <form method="POST" action="/listings" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label
                for="artist"
                class="inline-block text-lg mb-2"
                >Artist Name</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="artist" value="{{old('artist')}}"
            />
            @error('artist')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="title" class="inline-block text-lg mb-2"
                >Album Title</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="title"
                value="{{old('title')}}"
            />
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="year"
                class="inline-block text-lg mb-2"
                >Release year</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="year"
                value="{{old('year')}}"
            />
            @error('year')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="label" class="inline-block text-lg mb-2"
                >Label</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="label"
                value="{{old('label')}}"
            />
            @error('label')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="website"
                class="inline-block text-lg mb-2"
            >
                RateYourMusic page
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="website"
                value="{{old('website')}}"
            />
            @error('website')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="tags" class="inline-block text-lg mb-2">
                Genres (Comma Separated)
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="tags"
                placeholder="Example: hiphop, indie rock, baroque pop, etc"
                value="{{old('tags')}}"
            />
            @error('tags')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="logo" class="inline-block text-lg mb-2">
                Album cover
            </label>
            <input
                type="file"
                class="border border-gray-200 rounded p-2 w-full"
                name="logo"
            />

            @error('logo')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>


        <div class="mb-6">
            <label
                for="description"
                class="inline-block text-lg mb-2"
            >
                About the album
            </label>
            <textarea
                class="border border-gray-200 rounded p-2 w-full"
                name="description"
                rows="10"
                placeholder="review or informations about the album"
                
            >{{old('description')}}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button
                class="bg-laravel text-black rounded py-2 px-4 hover:bg-black hover:text-laravel"
            >
                Create album
            </button>

            <a href="/" class="text-black ml-4"> Back </a>
        </div>
    </form>
</x-card>
</x-layout>