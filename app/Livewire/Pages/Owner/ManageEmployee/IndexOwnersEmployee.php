<?php

namespace App\Livewire\Pages\Owner\ManageEmployee;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexOwnersEmployee extends Component
{
    //database fields
    public $user;
    public $role;

  

    #[Computed()]
    //get all users with their roles
    public function users()
    {
        return User::query()
        ->select('id','name','email','created_at')
        ->with('roles:id,name')
        ->whereHas('roles', function ($query) {
            $query->where('name', 'employee');
        })
        ->where('created_by', Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->get();
        // this should show all the users with their roles in the view
    }

    #[Layout('components.layouts.owner')]
    public function render()
    {
        return view('livewire.pages.owner.manage-employee.index-owners-employee');
    }
}
