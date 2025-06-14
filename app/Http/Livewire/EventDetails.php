<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EventDetails extends Component
{
    public $event;
    public $modalVisible = false;

    protected $listeners = ['showEventDetails'];

    public function showEventDetails($eventData)
    {
        $this->event = $eventData;
        $this->modalVisible = true;
    }

    public function render()
    {
        return view('livewire.event-details');
    }
}

