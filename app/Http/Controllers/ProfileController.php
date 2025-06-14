<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();


        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],

            'current_password' => ['nullable', 'required_with:password', 'string'],
            'password' => ['nullable', 'required_with:current_password', 'string', 'min:8', 'confirmed'],
        ]);


        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);


        if (!empty($validatedData['password'])) {

            if (!Hash::check($validatedData['current_password'], $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'La contraseña actual es incorrecta'])
                    ->withInput();
            }


            $user->password = Hash::make($validatedData['password']);
            $user->save();
        }

        return redirect()->route('profile.show')->with('success', 'Perfil actualizado correctamente.');
    }
}
