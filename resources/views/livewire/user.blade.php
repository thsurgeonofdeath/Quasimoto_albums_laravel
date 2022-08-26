<table class="text-left border-r border-l border-gray-200">
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
        <th scope="col" class="text-sm font-medium text-black px-6 py-4">
        </th>
      </tr>
    </thead class="border-b">
    <tbody>
        @foreach ($users as $user)
        <tr class="bg-white border-b">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                <a href="/users/display/{{$user->id}}">{{$user->name}}</a>
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
            @if(!$user->isBlocked)
            <td>
                <button wire:click="blockUser({{ $user->id }})" class="text-red-500 bg-white py-4 w-48 hover:bg-red-400 hover:text-white">
                  Block
                </button>
            </td>
            @else
            <td>
              <button wire:click="unblockUser({{ $user->id }})" class="text-white bg-red-700 py-4 w-48 hover:bg-red-900">
                Unblock
              </button>
            </td>
            @endif
            @if($user->role == 'user')
            <td>
                    <button wire:click="turnWriter({{ $user->id }})" class="text-white bg-emerald-500 py-4 w-60 hover:bg-emerald-700">
                        Give Writing privileges 
                    </button>
            </td>          
            @else
            <td>
              <div>
                  <button wire:click="removeWriter({{ $user->id }})" class="text-white bg-yellow-600  py-4 w-60 hover:bg-yellow-800">
                      Remove Writing previleges
                  </button>
              </div>
            </td>       
            @endif
            <td class="content-center ">
              <form wire:submit="deleteUser({{$user->id}})">
                <button onclick="return confirm('Are you sure you want to delete this user?');" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-5" viewBox="0 0 20 20" fill="gray">
                  <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                </button>
              </form>
            </td>   
        </tr class="bg-white border-b">
        @endforeach                     
    </tbody>
</table>