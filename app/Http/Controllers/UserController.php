<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validación
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'dni' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'codigoPostal' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'sexo' => 'required|string|max:10',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Actualización de campos
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dni = $request->dni;
        $user->apellidos = $request->apellidos;
        $user->telefono = $request->telefono;
        $user->ciudad = $request->ciudad;
        $user->codigoPostal = $request->codigoPostal;
        $user->provincia = $request->provincia;
        $user->edad = $request->edad;
        $user->sexo = $request->sexo;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('mensaje', 'Perfil actualizado correctamente.');
    }
}
