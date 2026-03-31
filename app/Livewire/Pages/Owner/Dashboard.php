<?php

namespace App\Livewire\Pages\Owner;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('components.layouts.owner')]
    public function render()
    {
        return view('livewire.pages.owner.dashboard');
    }
}
