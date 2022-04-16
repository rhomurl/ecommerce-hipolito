<tr class="text-gray-700 dark:text-gray-400">
    <td class="px-4 py-3">
        <div class="flex items-center text-sm">
            <!-- Avatar with inset shadow -->
            <div>
                <p class="font-semibold">{{ $user->name }}</p>
            </div>
        </div>
    </td>
    
    <td class="px-4 py-3">
        <div class="flex items-center text-sm">
            <!-- Avatar with inset shadow -->
            <div>
                <p class="font-semibold">{{  $user->getRoleNames()->first() }}</p>
            </div>
        </div>
    </td>

    <td class="px-4 py-3">
        <div class="flex items-center space-x-4 text-sm">
            <button onclick='Livewire.emit("openModal", "admin.role-edit", {{ json_encode(["id" => $user->id]) }})'  class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Edit</button>
        </div>
    </td>

</tr>