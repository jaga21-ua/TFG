<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


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
        $user->comunidad = $request->comunidad;
        $user->edad = $request->edad;
        $user->sexo = $request->sexo;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('mensaje', 'Perfil actualizado correctamente.');
    }
    public function index()
    {
        $users = User::paginate(10);
        return view('users', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('usersEdit', compact('user'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $user = User::find($id);
        // Actualizar campos del usuario
        $user->name = $request->input('name');
        $user->apellidos = $request->input('apellidos');
        $user->dni = $request->input('dni');
        $user->email = $request->input('email');
        $user->telefono = $request->input('telefono');
        $user->codigoPostal = $request->input('codigoPostal');
        $user->ciudad = $request->input('ciudad');
        $user->provincia = $request->input('provincia');
        $user->comunidad = $request->input('comunidad');
        $user->edad = $request->input('edad');
        $user->sexo = $request->input('sexo');
        
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }
}
