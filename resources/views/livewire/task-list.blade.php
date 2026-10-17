<div>
    @if (session('success'))
        <div class="alert alert-success mb-4">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search tasks..."
            class="input input-bordered w-full sm:max-w-xs" />

        <select wire:model.live="status" class="select select-bordered w-full sm:w-44">
            <option value="">All statuses</option>
            <option value="not started">Not started</option>
            <option value="doing">In progress</option>
            <option value="done">Done</option>
        </select>

        <select wire:model.live="priority" class="select select-bordered w-full sm:w-44">
            <option value="">All priorities</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>

        <div class="sm:ml-auto">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Add task</a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-box bg-base-100 shadow">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Start</th>
                    <th>End</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    @php
                        $statusBadge = match ($task->status) {
                            'done' => 'badge-success',
                            'doing' => 'badge-warning',
                            default => 'badge-ghost',
                        };
                        $priorityBadge = match ($task->priority) {
                            'high' => 'badge-error',
                            'medium' => 'badge-warning',
                            default => 'badge-info',
                        };
                    @endphp
                    <tr wire:key="task-{{ $task->id }}" class="hover">
                        <th>{{ $tasks->firstItem() + $loop->index }}</th>
                        <td>
                            <div class="font-semibold">{{ $task->name }}</div>
                            <div class="max-w-xs truncate text-xs opacity-60">
                                {{ \Illuminate\Support\Str::limit($task->description, 80) }}
                            </div>
                        </td>
                        <td><span class="badge {{ $statusBadge }}">{{ $task->status }}</span></td>
                        <td><span class="badge {{ $priorityBadge }}">{{ $task->priority }}</span></td>
                        <td class="text-sm">{{ $task->startTime?->format('Y-m-d') }}</td>
                        <td class="text-sm">{{ $task->endTime?->format('Y-m-d') }}</td>
                        <td class="whitespace-nowrap text-right">
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-ghost btn-xs">Show</a>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-ghost btn-xs">Edit</a>
                            <button wire:click="delete({{ $task->id }})" wire:confirm="Delete this task?"
                                class="btn btn-ghost btn-xs text-error">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-10 text-center opacity-60">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
</div>
