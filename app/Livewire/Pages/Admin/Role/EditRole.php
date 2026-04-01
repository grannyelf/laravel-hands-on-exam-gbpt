<?php

namespace App\Livewire\Pages\Admin\Role;

use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRole extends Component
{
    //database fields
    public $roleId;
    public $name;
    public $selectedPermissions = [];

    public function mount($id)
    {
        $this->roleId = $id;
        $this->loadRoleData();
    }

    #[Computed()]
    public function loadRoleData()
    {
        $role = Role::findById($this->roleId);
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions()->pluck('name')->toArray();
    }

        //get all permissions name from the permissions table
    #[Computed()]
    public function permissions()
    {
        return Permission::query()->select('id','name')->get();
    }

    //validation of data from the user input/from model binding
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:roles,name,' . $this->roleId,
            // i added $this->roleId to ignore the current role name when checking for uniqueness
            'selectedPermissions' => 'required|array|min:1',
            'selectedPermissions.*' => 'exists:permissions,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The role name is required.',
            'name.unique' => 'The role name must be unique/already taken.',
            'selectedPermissions.required' => 'Please select at least one permission.',
        ];
    }

    //update method with validation, sanitization and updating data to table
    public function update()
    {
        $this->validate();
        //sanitize
        $roleName = Str::of($this->name)->trim()->title()->lower();
        //1. find the role
        $role = Role::findById($this->roleId);
        //2. update role name
        $role->update([
            'name' => $roleName
        ]);
        //3. sync permissions
        $role->syncPermissions($this->selectedPermissions);
        return redirect()->route('admin.index.role')->with('success', 'Role updated successfully.');
    }
    public function render()
    {
        return view('livewire.pages.admin.role.edit-role');
    }
}
