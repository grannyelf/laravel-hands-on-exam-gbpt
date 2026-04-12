<?php

namespace App\Livewire\Pages\Owner\AssignTask;

use App\Models\Task;
use App\Models\TaskUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexTask extends Component
{
    public $task;

    #[Computed()]
    public function tasks()
    {
        return Task::query()
            ->select('id', 'title', 'description', 'is_completed', 'user_id', 'created_at', 'created_by', 'updated_by')
            ->with('user:id,name', 'creator:id,name')
            ->where('created_by', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    #[Computed()]
    public function assigns()
    {
        return TaskUser::query()
            ->select('task_id', 'user_id', 'is_done', 'created_at', 'updated_at')
            ->with([
                'user:id,name',
                'task:id,title,description,created_at,updated_at'
            ])
            ->whereHas('task', function ($query) {
                $query->where('created_by', Auth::id());
            })
            ->get();
    }

    public function delete($taskId)
    {
        TaskUser::where('task_id', $taskId)->delete();

        Task::where('id', $taskId)->delete();

        session()->flash('message', 'Task deleted successfully.');
    }

    public function unassign($taskId, $userId)
    {
        TaskUser::where('task_id', $taskId)
            ->where('user_id', $userId)
            ->delete();

        session()->flash('message', 'Task deleted successfully.');
    }

    public function reassign($taskId, $userId)
    {
        TaskUser::where('task_id', $taskId)
            ->where('user_id', $userId)
            ->update(['is_done' => false]);

        session()->flash('message', 'Task restarted successfully.');
    }
    #[Layout('components.layouts.owner')]
    public function render()
    {
        return view('livewire.pages.owner.assign-task.index-task');
    }
}
