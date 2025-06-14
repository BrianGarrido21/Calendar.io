<?php

namespace App\Http\Requests;

use App\Rules\DueDateBeforeEventEnd;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambia según la lógica de autorización si la necesitas
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => [
                'required',
                'date',
                new DueDateBeforeEventEnd($this->input('event_id')),
            ],
            'event_id' => 'required|exists:events,id',
            'status_id' => 'required|exists:statuses,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser un texto válido.',
            'title.max' => 'El título no puede tener más de 255 caracteres.',
            'description.string' => 'La descripción debe ser un texto válido.',
            'due_date.required' => 'La fecha límite es obligatoria.',
            'due_date.date' => 'La fecha límite debe ser una fecha válida.',
            'event_id.required' => 'El evento es obligatorio.',
            'event_id.exists' => 'El evento seleccionado no existe.',
            'status_id.required' => 'El estado es obligatorio.',
            'status_id.exists' => 'El estado seleccionado no existe.',
        ];
    }
}
