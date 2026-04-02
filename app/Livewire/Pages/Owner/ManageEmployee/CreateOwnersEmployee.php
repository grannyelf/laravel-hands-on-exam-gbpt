<?php

namespace App\Livewire\Pages\Owner\ManageEmployee;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateOwnersEmployee extends Component
{
    //database fields
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $selectedRole;
    public $roles = [];

    //initialize roles on mount
    public function mount()
    {
        $roles = Role::select('id', 'name')->get();
        $this->roles = $roles;
    }

    //validation rules
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email|max:255',
            'password' => 'required|string|min:6|max:255',
            'password_confirmation' => 'required|string|min:6|same:password|max:255',
            'selectedRole' => 'required|min:1|exists:roles,name',
        ];
    }

    //custom validation messages
    public function messages()
    {
        return [
            'name.required' => 'The name is required.',
            'name.min' => 'The name must be at least 3 characters.',
            'name.max' => 'The name must not exceed 255 characters.',

            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'email.max' => 'The email must not exceed 255 characters.',

            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.max' => 'The password must not exceed 255 characters.',
            'password_confirmation.required' => 'The password confirmation is required.',
            'password_confirmation.min' => 'The password confirmation must be at least 6 characters.',
            'password_confirmation.max' => 'The password confirmation must not exceed 255 characters.',
            'password_confirmation.same' => 'The password confirmation must match the password.',

            'selectedRole.required' => 'Please select at least one role.',
            'selectedRole.min' => 'Please select at least one role.',
            'selectedRole.exists' => 'The selected role is invalid.',
        ];
    }

    //save method with validation, sanitization and saving data to table
    public function save()
    {
        $this->validate();

        //sanitize
        $name = Str::of($this->name)->trim()->title();
        $email = Str::of($this->email)->trim()->lower();

        //create user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($this->password),
        ]);

        //sync roles
        $user->syncRoles($this->selectedRole);

        //reset form fields after saving
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'selectedRole']);

        return redirect()->route('admin.index.user')->with('success', 'User created successfully.');
    }
    
    public function render()
    {
        return view('livewire.pages.owner.manage-employee.create-owners-employee');
    }
}
