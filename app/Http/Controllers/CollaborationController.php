<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollaborationController extends Controller
{
    public function createCollaborations(Event $event)
    {
        return view('events.create-Collaborations', compact('event'));
    }

    public function storeCollaboration(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.exists' => 'El correo electrónico no está registrado en el sistema.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first('email'))
                ->withInput();
        }

        $user = \App\Models\User::where('email', $request->email)->first();


        if (!$user) {
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }
        
        if ($user->id === $event->user_id) {
            return redirect()->back()->with('error', 'El propietario del evento no puede ser colaborador.');
        }
        if (!$event->collaborations()->where('user_id', $user->id)->exists()) {
            $event->collaborations()->attach($user->id);
            return redirect()->back()->with('success', 'Colaborador agregado correctamente.');
        }

        return redirect()->back()->with('error', 'El usuario ya es colaborador de este evento.');
    }
}
