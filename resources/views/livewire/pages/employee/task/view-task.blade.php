<div>

    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 py-12 lg:py-24 mx-auto">
        <!-- Card Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
            @forelse ($this->tasks() as $tkey => $task)
                <div wire:click="{{ $tkey }}">
                    <!-- Card -->
                    <div class="group flex flex-col">
                        <div class="relative">
                            <div class="pt-4">
                                <h3 class="font-medium md:text-lg text-foreground">
                                    Task: {{ $task->task->title }}
                                </h3>

                                <p class="gap mt-2 font-semibold text-foreground">
                                    Assigned by: {{ $task->task->creator ? $task->task->creator->name : 'N/A' }}
                                    {{ $task->task->creator ? $task->task->creator->roles->pluck('name')->map(fn($r) => '(' . str_replace('_', ' ', $r) . ')')->join(' ') : '' }}
                                </p>
                            </div>

                        </div>

                        <div class="mb-2 mt-4 text-sm">
                            <!-- List -->
                            <div class="flex flex-col">
                                <!-- Item -->
                                <div class="py-3 border-t border-line-2">
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <span class="font-medium text-foreground">Status:</span>
                                        </div>

                                        <div class="text-end">
                                            <span class="text-foreground">{{ $task->is_done ? 'Completed' : 'Pending' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Item -->

                                <!-- Item -->
                                <div class="py-3 border-t border-line-2">
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <span class="font-medium text-foreground">Created At:</span>
                                        </div>

                                        <div class="text-end">
                                            <span
                                                class="text-foreground">{{ $task->task->created_at->format('Y-m-d H:i:s') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Item -->
                            </div>
                            <!-- End List -->
                        </div>

                        <div class="mt-auto">
                            <a class="py-2 px-3 w-full inline-flex justify-center items-center gap-x-2 text-sm font-medium text-nowrap rounded-xl bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus transition disabled:opacity-50 disabled:pointer-events-none"
                                href="{{ route('employee.task.edit', $task->task->id) }}">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <span>No tasks found.</span>
            @endforelse
            <!-- End Card -->
        </div>
        <!-- End Card Grid -->
    </div>
    <!-- End Listings -->
</div>
