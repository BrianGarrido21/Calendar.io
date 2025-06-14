<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class DeleteTaskConfirmModal extends Component
{
    public $showModal = false;
    public $taskId;

    protected $listeners = ['openDeleteTaskModal' => 'openModal'];

    public function openModal($taskId)
    {
        $this->taskId = $taskId;
        $this->showModal = true;
    }

    public function deleteTask()
    {
        $task = Task::find($this->taskId);

        if ($task) {
            $task->delete();

            redirect()->route('tasks.index')->with('success', '¡Tarea eliminada correctamente!');

        }

        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.delete-task-confirm-modal');
    }
}
