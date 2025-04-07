<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\User;

new class extends Component {
    use WithPagination; // Add this trait

    public function getUsers()
    {
        return User::paginate(2);
    }
};
?>

<div class="py-12">
    <h2 class="text-xl font-bold mb-4">Users</h2>
    <div class="border py-5 px-4 rounded-xl">
        <div class="overflow-y-auto mb-3">

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="font-semibold ">
                        <th scope="col" class="p-3">First Name</th>
                        <th scope="col" class="p-3">Last Name</th>
                        <th scope="col" class="p-3">Email</th>
                        <th scope="col" class="p-3">Role</th>
                        <th scope="col" class="p-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->getUsers() as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="p-3">{{ $user->first_name }}</td>
                            <td class="p-3">{{ $user->last_name }}</td>
                            <td class="p-3">{{ $user->email }}</td>
                            <td class="p-3">{{ $user->role }}</td>
                            <td class="p-3">{{ $user->status ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $this->getUsers()->links() }}
    </div>
</div>
