<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'description' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'status_id' => 'required|exists:statuses,id',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules = array_map(function ($rule) {
                return str_replace('required|', '', $rule);
            }, $rules);
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'description.required' => 'La descripción es obligatoria',
            'description.max' => 'La descripción no puede tener más de 255 caracteres',
            'location.required' => 'La ubicación es obligatoria',
            'location.max' => 'La ubicación no puede tener más de 255 caracteres',
            'start_datetime.required' => 'La fecha y hora de inicio es obligatoria',
            'start_datetime.date' => 'La fecha y hora de inicio debe ser una fecha válida',
            'end_datetime.required' => 'La fecha y hora de finalización es obligatoria',
            'end_datetime.date' => 'La fecha y hora de finalización debe ser una fecha válida',
            'end_datetime.after' => 'La fecha y hora de finalización debe ser posterior a la fecha de inicio',
            'repeat_pattern.required' => 'El patrón de repetición es obligatorio',
            'repeat_pattern.in' => 'El patrón de repetición debe ser: none, daily, weekly, monthly o yearly',
            'status_id.required' => 'El estado es obligatorio',
            'status_id.exists' => 'El estado seleccionado no existe',
        ];
    }
}
