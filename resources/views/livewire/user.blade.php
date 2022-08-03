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
          User Actions
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
            <td>
                <div>
                    <button wire:click="turnWriter({{ $user->id }})" class="text-white bg-emerald-500 font-light py-4 w-60 hover:bg-emerald-700">
                        Give Writing privileges 
                    </button>
                </div>
            </td>          
            @else
            <td>
              <div>
                  <button wire:click="removeWriter({{ $user->id }})" class="text-white bg-yellow-600 font-light  py-4 w-60 hover:bg-cyan-800">
                      Remove Writing previleges
                  </button>
              </div>
          </td>       
            @endif   
        </tr class="bg-white border-b">
        @endforeach                     
    </tbody>
</table>