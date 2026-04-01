<?php

namespace App\Livewire\Pages\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class EditUser extends Component
{
    //database fields
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $selectedRole;
    public $roles = [];

    public function mount($id)
    {
        $this->userId = $id;
        $this->loadUserData(); //this method will load user data
    }


    #[Computed()]
    public function loadUserData()
    {
        //fetch user data based on userId
        $user = User::query()->with('roles')->findOrFail($this->userId);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->password_confirmation = $user->password;
        $this->selectedRole = $user->roles->pluck('name')->toArray();

        //initialize roles
        $roles = Role::query()->select('id', 'name')->get();
        $this->roles = $roles;
    }

    //validation rules
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
            'selectedRole' => 'required|min:1|exists:roles,name',
        ];
    }

    //custom validation messages
    public function messages()
    {
        return [
            'name.required' => 'The name is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'password_confirmation.required' => 'The password confirmation is required.',
            'password_confirmation.min' => 'The password confirmation must be at least 6 characters.',
            'password_confirmation.same' => 'The password confirmation must match the password.',
            'selectedRole.required' => 'Please select at least one role.',
            'selectedRole.min' => 'Please select at least one role.',
            'selectedRole.exists' => 'The selected role is invalid.',
        ];
    }

    //update method with validation, sanitization and updating data to table
    public function update()
    {
        $this->validate();

        //sanitize
        $name = Str::of($this->name)->trim()->title();
        $email = Str::of($this->email)->trim()->lower();
        $selectedRole = $this->selectedRole;

        //create user
        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($this->password),
        ]);

        //assign roles
        $user = User::find($this->userId);
        $user->syncRoles($selectedRole);

        return redirect()->route('admin.index.user')->with('success', 'User updated successfully.');
        //this should redirect back to the view page
    }
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.pages.admin.user.edit-user');
    }
}
