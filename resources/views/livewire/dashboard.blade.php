<div class="space-y-8">
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="stat rounded-box bg-base-100 shadow">
            <div class="stat-title">Total tasks</div>
            <div class="stat-value text-primary">{{ $total }}</div>
        </div>
        <div class="stat rounded-box bg-base-100 shadow">
            <div class="stat-title">Not started</div>
            <div class="stat-value">{{ $byStatus['not started'] }}</div>
        </div>
        <div class="stat rounded-box bg-base-100 shadow">
            <div class="stat-title">In progress</div>
            <div class="stat-value text-warning">{{ $byStatus['doing'] }}</div>
        </div>
        <div class="stat rounded-box bg-base-100 shadow">
            <div class="stat-title">Done</div>
            <div class="stat-value text-success">{{ $byStatus['done'] }}</div>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-3">
        <div class="rounded-box bg-base-100 p-4 shadow">
            <div class="text-xs uppercase opacity-60">Low priority</div>
            <div class="text-2xl font-semibold text-info">{{ $byPriority['low'] }}</div>
        </div>
        <div class="rounded-box bg-base-100 p-4 shadow">
            <div class="text-xs uppercase opacity-60">Medium priority</div>
            <div class="text-2xl font-semibold text-warning">{{ $byPriority['medium'] }}</div>
        </div>
        <div class="rounded-box bg-base-100 p-4 shadow">
            <div class="text-xs uppercase opacity-60">High priority</div>
            <div class="text-2xl font-semibold text-error">{{ $byPriority['high'] }}</div>
        </div>
    </div>

    <div class="rounded-box bg-base-100 p-6 shadow">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Recent tasks</h2>
            <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-primary">View all</a>
        </div>

        <ul class="divide-y divide-base-200">
            @forelse ($recent as $task)
                <li class="flex items-center justify-between gap-4 py-3">
                    <div>
                        <a href="{{ route('tasks.show', $task) }}" class="font-medium hover:underline">
                            {{ $task->name }}
                        </a>
                        <div class="text-xs opacity-60">{{ $task->status }} · {{ $task->priority }}</div>
                    </div>
                    <span class="text-xs opacity-60">{{ $task->created_at?->format('Y-m-d H:i') }}</span>
                </li>
            @empty
                <li class="py-6 text-center opacity-60">No tasks yet.</li>
            @endforelse
        </ul>
    </div>
</div>
