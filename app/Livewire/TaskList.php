<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class TaskList extends Component
{
    use WithPagination;

    public string $search = '';

    public string $status = '';

    public string $priority = '';

    public int $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'priority' => ['except' => ''],
    ];

    public function updating(string $name): void
    {
        if (in_array($name, ['search', 'status', 'priority', 'perPage'], true)) {
            $this->resetPage();
        }
    }

    public function delete(int $id): void
    {
        auth()->user()->tasks()->findOrFail($id)->delete();

        session()->flash('success', 'Task deleted.');
    }

    public function render()
    {
        $tasks = auth()->user()->tasks()
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('description', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->status !== '', fn ($query) => $query->where('status', $this->status))
            ->when($this->priority !== '', fn ($query) => $query->where('priority', $this->priority))
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.task-list', compact('tasks'));
    }
}
