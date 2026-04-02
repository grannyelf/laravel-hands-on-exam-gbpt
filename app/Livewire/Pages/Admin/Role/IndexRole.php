<?php

namespace App\Livewire\Pages\Admin\Role;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class IndexRole extends Component
{
    public $role;
    public $permissions;
    public $defaultPermissions;

    #[Computed()]
    public function roles()
    {
        return Role::query()
            ->with('permissions:id,name')
            ->select('id', 'name', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();
        // with is an eager loading method that is used to load the related permissions of the roles
        // it will load the permissions of each role in a single query instead of loading them in multiple queries
        // this will improve the performance of the application and reduce the number of queries to the database
        // and select is used to select only the required fields from the roles table
        // this will also improve the performance of the application and reduce the amount of data that is retrieved from the database, and we are selecting the id
    }

 

    public function delete($id)
    {
        $role = Role::findById($id);
        $role->delete();
        // this will delete the role from the database
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.pages.admin.role.index-role');
    }
}
