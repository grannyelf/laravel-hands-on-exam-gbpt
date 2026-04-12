<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogIn extends Component
{
    public $name;
    public $email;
    public $password;
    public bool $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            if (Auth::user()->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard'));
            } elseif (Auth::user()->hasRole('employee')) {
                return redirect()->intended(route('employee.dashboard'));
            } elseif (Auth::user()->hasRole('owner')) {
                return redirect()->intended(route('owner.dashboard'));
            }
        }

        $this->addError('password', 'The provided credentials do not match our records.');
        return;
    }

    public function render()
    {
        return view('livewire.auth.log-in');
    }
}
