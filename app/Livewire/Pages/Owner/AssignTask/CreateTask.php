<?php

namespace App\Livewire\Pages\Owner\AssignTask;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateTask extends Component
{
    public $title;
    public $description;
    public $is_completed = false;
    public $user_ids = [];
    public $created_by;
    public $users = [];

    public function mount()
    {
        $this->users = User::query()
            ->select('id', 'name')
            ->where('created_by', Auth::id())
            ->whereHas('roles', function ($query) {
                $query->where('name', 'employee');
            })
            ->get();
    }

    public function rules()
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|min:3|max:255',
            'is_completed' => 'nullable|boolean',
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title must not exceed 255 characters.',
            'description.min' => 'The description must be at least 3 characters.',
            'description.max' => 'The description must not exceed 255 characters.',
            'is_completed.boolean' => 'The completion status must be true or false.',
            'user_ids.required' => 'Please select at least one user to assign the task to.',
            'user_ids.array' => 'The selected users must be an array.',
            'user_ids.*.exists' => 'One of the selected users is invalid.',
        ];
    }

    public function save()
    {
        $this->validate();
        $title = Str::of($this->title)->trim()->title();
        $description = Str::of($this->description)->trim();
        $is_completed = $this->is_completed;
        $user_ids = $this->user_ids;

        $task = Task::create([
            'title' => $title,
            'description' => $description,
            'is_completed' => $is_completed,
            'user_id' => $user_ids[0] ?? null,
            'created_by' => Auth::id(),
        ]);

        $task->users()->sync($user_ids);

        $this->reset(['title', 'description', 'is_completed', 'user_ids']);
        session()->flash('success', 'Task created successfully.');
    }
    #[Layout('components.layouts.owner')]
    public function render()
    {
        return view('livewire.pages.owner.assign-task.create-task');
    }
}
