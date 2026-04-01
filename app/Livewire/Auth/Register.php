<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255|min:2',
        'email' => 'required|email|max:255|min:10|unique:users',
        'password' => 'required|string|max:255|min:8|confirmed',
    ];

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 2 characters.',
            'name.max' => 'The name must not be greater than 255 characters.',
            
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email must not be greater than 255 characters.',
            'email.min' => 'The email must be at least 10 characters.',
            'email.unique' => 'The email has already been taken.',

            'password.required' => 'The password field is required.',
            'password.max' => 'The password must not be greater than 255 characters.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $user->assignRole('owner');

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
