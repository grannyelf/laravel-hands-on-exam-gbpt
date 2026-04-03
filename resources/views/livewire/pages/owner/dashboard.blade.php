<div>
    <div class="p-5">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-200">Owner Dashboard</h1>
        @foreach ($this->users() as $user)
            <p class="text-sm text-gray-600 dark:text-neutral-400">Welcome to your dashboard {{ $user->name }}, manage
                your employees and assign tasks.</p>
        @endforeach
    </div>
</div>
