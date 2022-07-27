@section('style')
<style>
/* CHECKBOX TOGGLE SWITCH */
/* @apply rules for docu, this will not work as inline style */
.toggle-checkbox:checked {
    @apply: right-0 border-green-400;
    right: 0;
    border-color: #68D391;
}
.toggle-checkbox:checked + .toggle-label {
    @apply: bg-green-400;
    background-color: #68D391;
}
</style>
@endsection

<tr class="text-gray-700 dark:text-gray-400">
    <td class="px-4 py-3">
        <div class="flex items-center text-sm">
            <!-- Avatar with inset shadow -->
            <div>
                <p class="font-semibold">{{ $user->name }}</p>
            </div>
        </div>
    </td>
    
        {{--<td class="px-4 py-3">
            <div class="flex items-center text-sm">
                <!-- Avatar with inset shadow -->
                <div>
                    <p class="font-semibold">{{ $user->email }}</p>
                </div>
            </div>
        </td>--}}
        
        <td class="px-4 py-3">
            <div class="flex items-center text-sm">
                <!-- Avatar with inset shadow -->
                <div>
                    <p class="font-semibold">{{ $user->email_verified_at == NULL ? 'Not Verified ': 'Verified' }}</p>
                </div>
            </div>
        </td>

        <td class="px-4 py-3">
            <div class="flex items-center text-sm">
                <!-- Avatar with inset shadow -->
                <div>
                    <p class="font-semibold">{{ $user->created_at->diffForHumans(); }}</p>
                </div>
            </div>
        </td>
    
    
    <td class="px-4 py-3">
        <div class="flex items-center space-x-4 text-sm">
            <button wire:click="view({{ $user->id }})" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
            </button>

            @role('super-admin|admin')
            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                <input wire:click.prevent="changeUserStatus({{$user->id}}, @if($user->status == 1) {{ '0 '}} @else {{ '1' }} @endif)" type="checkbox" name="toggle" id="toggle" class="focus:outline-none toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" @if($user->status == 1) checked @endif/>
                <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer" ></label>
            </div>
            @endrole

            {{--<div x-data="{ confirmDelete:false }" class="flex flex-wrap -mx-2 overflow-hidden">
                <button x-show="!confirmDelete" x-on:click="confirmDelete=true" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                    Ban
                </button>
                <div class="my-2 px-2 w-1/2 overflow-hidden">
                    <button x-show="confirmDelete" x-on:click="confirmDelete=false"  wire:click="ban({{ $user->id }})" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">Yes</button>
                </div>
              
                <div class="my-2 px-2 w-1/2 overflow-hidden">
                    <button x-show="confirmDelete" x-on:click="confirmDelete=false" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">No</button>   
                </div>
              </div>--}}
        </div>
        
        
    </td>
</tr>