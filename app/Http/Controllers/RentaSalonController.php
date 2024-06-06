<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentaSalon;
use PDF;

class RentaSalonController extends Controller
{

    public function create($users, Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'user_name' => 'required',
            'user_last_name' => 'required',
            'salon_id' => 'required',
            'salon_name' => 'required',
            'salon_price' => 'nullable',
            'meseros' => 'required|integer',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'numero_de_horas' => 'required|integer',
            'fecha' => 'required|date',
        ]);

        $salonUserRenta = new RentaSalon();
        $salonUserRenta->user_id = $request->user_id;
        $salonUserRenta->user_name = $request->user_name;
        $salonUserRenta->user_last_name = $request->user_last_name;
        $salonUserRenta->salon_id = $request->salon_id;
        $salonUserRenta->salon_name = $request->salon_name;
        $salonUserRenta->salon_price = $request->salon_price;
        $salonUserRenta->meseros = $request->meseros;
        $salonUserRenta->price = $request->price;
        $salonUserRenta->capacity = $request->capacity;
        $salonUserRenta->numero_de_horas = $request->numero_de_horas;
        $salonUserRenta->fecha = $request->fecha;

        $salonUserRenta->save();
        return redirect()->route('salones.index', $users)->with('success', 'Datos guardados correctamente');
    }

    public function showFormulario($salon, $usuario)
    {
        return view('renta.formulario', compact('salon', 'usuario'));
    }


    public function show($users)
    {
        $id = $users;
        $users = RentaSalon::where('user_id', $users)->get();
        return view('renta.show', compact('id', 'users'));
    }

    public function edit($renta)
    {
        $renta = RentaSalon::findOrFail($renta);
        return view('renta.edit', compact('renta'));
    }

    public function upload($id, Request $request)
    {
        $request->validate([
            'meseros' => 'required|integer',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'numero_de_horas' => 'required|integer',
            'fecha' => 'required|date',
        ]);

        $renta = RentaSalon::findOrFail($id);
        $renta->user_name = $request->user_name;
        $renta->user_last_name = $request->user_last_name;
        $renta->salon_name = $request->salon_name;
        $renta->meseros = $request->meseros;
        $renta->price = $request->price;
        $renta->capacity = $request->capacity;
        $renta->numero_de_horas = $request->numero_de_horas;
        $renta->fecha = $request->fecha;
        $renta->save();
        return redirect()->route('renta.show', $renta->user_id)->with('success', 'Datos actualizados correctamente');
    }

    public function delete($renta)
    {
        $renta = RentaSalon::findOrFail($renta);
        $renta->delete();
        return redirect()->back()->with('success', 'Reserva eliminada exitosamente');
    }
}
