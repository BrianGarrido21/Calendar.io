<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;

class DeleteEventModal extends Component
{
    public $showModal = false;
    public $eventId;

    protected $listeners = ['openDeleteEventModal'];

    public function openDeleteEventModal($eventId)
    {
        $this->eventId = $eventId;
        $this->showModal = true;
    }

    public function deleteEvent()
    {
        $event = Event::find($this->eventId);

        if ($event) {
            $event->delete();
            session()->flash('success', 'Evento eliminado correctamente.');
        } else {
            session()->flash('error', 'El evento no existe o ya fue eliminado.');
        }

        $this->reset(['showModal', 'eventId']);

        return redirect()->route('events.index');
    }


    public function render()
    {
        return view('livewire.delete-event-modal');
    }
}
