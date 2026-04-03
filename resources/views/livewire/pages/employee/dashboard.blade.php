<div>
    <div class="p-5">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-200">Employee Dashboard</h1>
        @foreach ($this->users() as $user)
            <p class="text-sm text-gray-600 dark:text-neutral-400">Welcome to your dashboard {{ $user->name }}, manage
                your tasks and view your progress.</p>
        @endforeach
    </div>
</div>
