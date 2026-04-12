<?php

namespace App\Livewire\Pages\Employee\Task;

use App\Models\TaskUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CompletedTask extends Component
{
    public $task;

    public function tasks()
    {
        return TaskUser::query()
            ->select('task_id', 'user_id', 'is_done', 'created_at', 'updated_at')
            ->with('user:id,name', 'task.creator:id,name', 'task:id,title,description,created_at,updated_at,created_by')
            ->where('is_done', true)
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    #[Layout('components.layouts.employee')]
    public function render()
    {
        return view('livewire.pages.employee.task.completed-task');
    }
}
