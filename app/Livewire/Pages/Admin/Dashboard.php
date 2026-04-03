<?php

namespace App\Livewire\Pages\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    public $user;
    public function users()
    {
        return User::select('id', 'name')->where('id', Auth::id())->get();
    }
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.pages.admin.dashboard');
    }
}
