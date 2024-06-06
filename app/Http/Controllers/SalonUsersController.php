<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalonUsers;
use App\Models\RentaSalon;
use App\Models\Salon;
use App\Models\SalonImage;
use Illuminate\Support\Facades\Session;

class SalonUsersController extends Controller
{

    public function check(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required',
        ]);

        $user = SalonUsers::where('email', $request->correo)->first();

        if ($user && password_verify($request->contraseña, $user->password)) {
            return redirect()->route('salones.index', $user);
        } else {
            Session::flash('error', 'Los datos ingresados son incorrectos.');
            return redirect()->route('home');
        }
    }

    public function registrar()
    {
        return view('users.registrar');
    }

    public function create(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
        ]);

        $user = new SalonUsers;
        $user->name = $request->input('nombre');
        $user->last_name = $request->input('apellidos');
        $user->email = $request->input('correo');
        $user->password = bcrypt($request->input('contraseña'));
        $user->save();

        return redirect()->route('home')->with('success', 'Salón actualizado exitosamente.');
    }

    public function show($id)
    {
        $user = SalonUsers::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|string|max:255',
            'contraseña' => 'required|string|max:255',
        ]);

        $user = SalonUsers::findOrFail($id);
        $user->name = $request->input('nombre');
        $user->last_name = $request->input('apellidos');
        $user->email = $request->input('correo');
        $user->password = $request->input('contraseña');
        $user->save();

        return redirect()->route('salones.mine', $id);
    }

    public function delete($id)
    {
        SalonUsers::findOrFail($id)->delete();
        //RentaSalon::where('user_id', $id)->delete();
        //$salonIds = Salon::where('onwer', $id)->pluck('id');
        //SalonImage::whereIn('onwer', $salonIds)->delete();
        //Salon::where('onwer', $id)->delete();
        return redirect()->route('home')->with('success', 'Salón actualizado exitosamente.');
    }
}
