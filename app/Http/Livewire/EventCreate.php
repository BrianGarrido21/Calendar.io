<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Status;
use App\Models\Tag;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class EventCreate extends Component
{
    public $description;
    public $location;
    public $status_id;
    public $start_datetime;
    public $end_datetime;
    public $tags = [];
    public $show = false;

    protected $listeners = [
        'showEventCreateModal' => 'openModal',
        'refreshComponent' => '$refresh'
    ];

    public function openModal($data)
    {
        $this->start_datetime = $data['start'];
        $this->end_datetime = $data['end'];
        $this->show = true;
    }

    public function rules()
    {
        return [
            'description' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'status_id' => 'required|exists:statuses,id',

        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser un texto.',
            'description.max' => 'La descripción no debe superar los 255 caracteres.',

            'location.string' => 'La ubicación debe ser un texto.',
            'location.max' => 'La ubicación no debe superar los 255 caracteres.',

            'status_id.required' => 'El estado es obligatorio.',
            'status_id.exists' => 'El estado seleccionado no es válido.',

            'start_datetime.required' => 'La fecha y hora de inicio es obligatoria.',
            'start_datetime.date' => 'La fecha de inicio no es válida.',

            'end_datetime.required' => 'La fecha y hora de fin es obligatoria.',
            'end_datetime.date' => 'La fecha de fin no es válida.',
            'end_datetime.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
        ];
    }

    public function createEvent()
    {
        $validated = $this->validate();

        $event = Event::create([
            'description' => $this->description,
            'location' => $this->location,
            'status_id' => $this->status_id,
            'start_datetime' => Carbon::parse($this->start_datetime),
            'end_datetime' => Carbon::parse($this->end_datetime),
            'user_id' => auth()->id(),
        ]);

        $event->tags()->sync($this->tags);

        redirect()->route('calendar.index');
    }

    public function render()
    {
        return view('livewire.event-create', [
            'statuses' => Status::all(),
            'tags' => Tag::all(),
        ]);
    }
}
