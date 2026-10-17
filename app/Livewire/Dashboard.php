<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $query = auth()->user()->tasks();

        $total = (clone $query)->count();

        $byStatus = [
            'not started' => (clone $query)->where('status', 'not started')->count(),
            'doing' => (clone $query)->where('status', 'doing')->count(),
            'done' => (clone $query)->where('status', 'done')->count(),
        ];

        $byPriority = [
            'low' => (clone $query)->where('priority', 'low')->count(),
            'medium' => (clone $query)->where('priority', 'medium')->count(),
            'high' => (clone $query)->where('priority', 'high')->count(),
        ];

        $recent = (clone $query)->latest()->take(5)->get();

        return view('livewire.dashboard', compact('total', 'byStatus', 'byPriority', 'recent'));
    }
}
