<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;

class ConfirmDeleteCollaborationModal extends Component
{
    public $showModal = false;
    public $eventId;
    public $collabId;

    protected $listeners = ['openDeleteModal'];

    public function openDeleteModal($eventId, $collabId)
    {
        $this->eventId = $eventId;
        $this->collabId = $collabId;
        $this->showModal = true;
    }
    public function deleteCollaboration()
    {
        $event = Event::findOrFail($this->eventId);
        $event->collaborations()->detach($this->collabId);
        $this->reset(['showModal', 'eventId']);
        
        return redirect()->route('events.createCollaborations',$event)->with('success', 'Colaborador eliminado correctamente.');

        $this->emit('collaborationDeleted', $this->collabId);

        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.confirm-delete-collaboration-modal');
    }

    
}
