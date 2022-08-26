<x-layout>
        <x-card class="max-w-lg mx-auto">
            <form action="/contactmessage/{{$authenticatedUserID}}" class="w-full max-w-lg" method="POST">
                @csrf
                <div class="flex justify-center">
                  <img src="{{asset('images/summerquas.png')}}" alt="doom" class="h-72">
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                      Contact Us
                    </label>
                    <textarea 
                    class="no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none" 
                    name="message">{{old('message')}}</textarea>
                    @error('message')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    <p class="text-gray-600 text-xs italic">He wears a mask just to cover the raw flesh</p>
                  </div>
                </div>
                  <div class="flex justify-center">
                    <button class="shadow bg-laravel text-black hover:bg-black hover:text-laravel font-bold py-2 px-4 rounded" 
                    type="submit">
                      Submit
                    </button>
                  </div>
              </form>
        </x-card>
</x-layout>