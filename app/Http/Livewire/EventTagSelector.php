<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;
use App\Models\Tag;

class EventTagSelector extends Component
{
    public $eventId;
    public $tags = [];
    public $selectedTags = [];

    // Propiedad para abrir/cerrar el modal desde Alpine
    public $showModal = false;

    protected $listeners = ['openTagModal' => 'openModal'];

    public function mount($eventId = null)
    {
        $this->tags = Tag::all();

        if ($eventId) {
            $this->eventId = $eventId;
            $this->selectedTags = Event::find($eventId)->tags()->pluck('tags.id')->toArray();
        }
    }

    public function openModal($eventId)
    {
        $this->eventId = $eventId;
        $this->tags = Tag::all();
        $this->selectedTags = Event::find($eventId)->tags()->pluck('tags.id')->toArray();

        $this->showModal = true;
    }

    public function save()
    {
        $event = Event::find($this->eventId);
        $event->tags()->sync($this->selectedTags);

        return redirect()->route('events.show', $this->eventId)->with('success', 'Etiquetas actualizadas correctamente.');
    }

    public function render()
    {
        return view('livewire.event-tag-selector');
    }
}
