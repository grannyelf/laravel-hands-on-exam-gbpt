<?php

namespace App\Livewire\Pages\Admin\User;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexUser extends Component
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
        ->orderBy('created_at', 'desc')
        ->get();
        // this should show all the users with their roles in the view
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        // this will delete the user from the database
    }
    
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.pages.admin.user.index-user');
    }
}
