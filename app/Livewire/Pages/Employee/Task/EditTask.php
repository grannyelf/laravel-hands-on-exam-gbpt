<?php

namespace App\Livewire\Pages\Employee\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\TaskUser;

class EditTask extends Component
{
    public $taskId;
    public $title;
    public $description;
    public $is_done = false;
    public $updated_by;

    public function mount($id)
    {
        $this->taskId = $id;
        $this->loadTaskData();
    }

    public function loadTaskData()
    {
        $task = Task::findOrFail($this->taskId);
        $this->title = $task->title;
        $this->description = $task->description;
    }

    public function rules()
    {
        return [
            'is_done' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'is_done.boolean' => 'The completion status must be true or false.',
        ];
    }

    public function update()
    {
        $this->validate();

        $task = Task::findOrFail($this->taskId);
        $is_done = $this->is_done;

        $task->update([
            'updated_by' => Auth::id(),
        ]);

        TaskUser::where(['task_id' => $this->taskId, 'user_id' => Auth::id()])->update(['is_done' => $is_done]);

        session()->flash('success', 'Task updated successfully.');
        return redirect()->route('employee.task.index');
    }
    #[Layout('components.layouts.employee')]
    public function render()
    {
        return view('livewire.pages.employee.task.edit-task');
    }
}
