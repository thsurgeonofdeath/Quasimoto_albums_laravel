<x-layout>
    
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full text-center">
                <thead class="border-b bg-laravel">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-black px-6 py-4">
                      Username
                    </th>
                    <th scope="col" class="text-sm font-medium text-black px-6 py-4">
                      Email
                    </th>
                    <th scope="col" class="text-sm font-medium text-black px-6 py-4">
                      Verified At
                    </th>
                    <th scope="col" class="text-sm font-medium text-black px-6 py-4">
                      Actions
                    </th>
                    <th scope="col" class="text-sm font-medium text-black px-6 py-4">
                    </th>
                  </tr>
                </thead class="border-b">
                <tbody>
                @foreach ($users as $user)
                  <tr class="bg-white border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{$user->name}}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{$user->email}}
                    </td>
                    @if(empty($user->email_verified_at))
                    <td class="text-sm text-red-500 px-6 py-4 whitespace-nowrap">
                        Not Verified yet   
                    @else
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{$user->email_verified_at}}
                    @endif
                    </td>
                    <td class="text-red-500 font-light px-6 py-4 hover:bg-red-400 hover:text-white">
                        Block
                    </td>
                    @if($user->role == 'user')
                    <td class="text-white bg-teal-500 font-light px-6 py-4 hover:bg-teal-800">
                        Make Writer
                    @else
                    <td class="text-white bg-emerald-600 font-light px-6 py-4 hover:bg-emerald-900">
                        Remove Writer role
                    @endif
                    </td>
                  </tr class="bg-white border-b">
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

</x-layout>