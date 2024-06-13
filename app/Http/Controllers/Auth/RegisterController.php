<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'DNI' => ['required', 'string', 'max:255'],
            'Telefono' => ['required', 'string', 'max:20'],
            'Apellidos' => ['required', 'string', 'max:255'],
            'Codigo_Postal' => ['required', 'string', 'max:10'],
            'ciudad' => ['required', 'string', 'max:255'],
            'provincia' => ['required', 'string', 'max:255'],
            'edad' => ['required', 'integer', 'min:1', 'max:120'],
            'sexo' => ['required', 'string', 'in:Masculino,Femenino,Otro'],
            'comunidad' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'dni' => $data['DNI'],
            'telefono' => $data['Telefono'],
            'apellidos' => $data['Apellidos'],
            'codigoPostal' => $data['Codigo_Postal'],
            'ciudad' => $data['ciudad'],
            'provincia' => $data['provincia'],
            'edad' => $data['edad'],
            'sexo' => $data['sexo'],
            'comunidad' => $data['comunidad'],
        ]);
    }
}
