<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskModal extends Component
{
    public $task;
    public $modalVisible = false;

    protected $listeners = ['showTaskModal'];

    public function showTaskModal($taskId)
    {
        // Obtenemos la tarea con los datos que quieres mostrar
        $this->task = Task::find($taskId);

        $this->modalVisible = true;
    }

    public function render()
    {
        return view('livewire.task-modal');
    }
}
