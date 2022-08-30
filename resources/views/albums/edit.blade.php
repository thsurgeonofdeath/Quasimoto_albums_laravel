<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
         <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                  Edit Album
            </h2>
                <p class="mb-4">Edit {{$album->title}}</p>
         </header>

        <form method="POST" action="/albums/{{$album->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label
                    for="artist"
                    class="inline-block text-lg mb-2"
                    >Artist Name</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="artist" value="{{$album->artist}}"
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
                    value="{{$album->title}}"
                />
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="type" class="inline-block text-lg mb-2"
                    >Type</label
                >
                <select class="border border-gray-200 rounded p-2 w-full" name="type">
                    <option value="{{$album->type}}" selected>{{$album->type}}</option>
                    <option value="EP">EP</option>
                    <option value="Mixtape">Mixtape</option>
                    <option value="Album">Album</option>
                    <option value="Live Album">Live Album</option>
                    <option value="Compilation">Compilation</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
    
            <div class="mb-6">
                <label
                    for="year"
                    class="inline-block text-lg mb-2"
                    >Release Year</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="year"
                    value="{{$album->year}}"
                />
                @error('year')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
    
            <div class="mb-6">
                <label for="tracklist" class="inline-block text-lg mb-2">
                    Tracklist (separated using %)
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="tracklist"
                    placeholder="Example: Beef Rap % Hoe Cakes % PotHolderz % etc"
                    value="{{$album->tracklist}}"
                />
                @error('tracklist')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="label" class="inline-block text-lg mb-2"
                    > Label</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="label"
                    value="{{$album->label}}"
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
                    value="{{$album->website}}"
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
                    value="{{$album->tags}}"
                />
                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
    
            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                     Album Cover
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="logo"
                />
                <img
                class="w-48 mr-6 mb-6"
                src="{{$album->logo? asset('storage/'.$album->logo) : asset('/images/bouchta.png')}}"
                alt=""
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
                    Album description
                </label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    rows="10"   
                >{{$album->description}}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
    
            <div class="mb-6 text-center flex justify-around items-center">
                <button
                    class="bg-laravel text-black rounded py-2 px-4 hover:bg-black hover:text-laravel"
                >
                    Save changes
                </button>
    
                <a href="/" class="text-black bg-black text-laravel py-1.5 px-4 rounded hover:bg-laravel hover:text-black"> Cancel </a>
            </div>
        </form>
    </x-card>
    </x-layout>