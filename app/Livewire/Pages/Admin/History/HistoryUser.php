<?php

namespace App\Livewire\Pages\Admin\History;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class HistoryUser extends Component
{
    public $user;

    public function users()
    {
        return User::onlyTrashed()->with('roles:id,name')->latest('created_at')->get();
    }

    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.pages.admin.history.history-user');
    }
}
