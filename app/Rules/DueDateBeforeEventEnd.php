<?php

namespace App\Rules;

use App\Models\Event;
use Illuminate\Contracts\Validation\Rule;

class DueDateBeforeEventEnd implements Rule
{
    protected $eventId;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    public function passes($attribute, $value)
    {
        if (!$this->eventId) {
            return true; // Si no se seleccionó evento, no validamos la fecha límite
        }

        $event = Event::find($this->eventId);

        if (!$event) {
            return true; // Si no existe el evento, no validamos
        }

        // Comparamos la fecha límite de la tarea con la fecha fin del evento
        return $value <= $event->end_datetime;
    }

    public function message()
    {
        return 'La fecha límite de la tarea no puede ser posterior a la fecha de finalización del evento.';
    }
}
