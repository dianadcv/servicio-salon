<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salon;
use App\Models\SalonImage;
use App\Models\SalonUsers;
use App\Models\RentaSalon;

class SalonController extends Controller
{

    public function registrar()
    {
        return view('salones.registrar');
    }

    public function index($users)
    {
        $user = SalonUsers::find($users);
        $salones = Salon::paginate();
        $salones_imagenes = SalonImage::paginate();
        return view('salones.index', compact('salones', 'salones_imagenes', 'user'));
    }


    public function create($users)
    {
        $user = SalonUsers::find($users);
        return view('salones.create', compact('user'));
    }

    public function store(Request $request, $users)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'owner' => 'required',
            'description' => 'required|string',
            'available' => 'boolean'
        ]);


        $filePaths = $this->upImagen($request);

        $salon = new Salon;
        $salon->name = $request->input('name');
        $salon->address = $request->input('address');
        $salon->capacity = $request->input('capacity');
        $salon->price = $request->input('price');
        $salon->owner = $request->input('owner');
        $salon->description = $request->input('description');
        $salon->available = $request->has('available');
        $salon->save();

        if (!empty($filePaths)) {
            foreach ($filePaths as $filePath) {
                $salonImage = new SalonImage;
                $salonImage->image = $filePath;
                $salonImage->salon_id = $salon->id;
                $salonImage->save();
                //unlink($filePath);
            }
        }
        return redirect()->route('salones.show', ['users' => $users, 'salon' => $salon])->with('success', 'Salón creado exitosamente.');
    }

    public function upImagen(Request $request)
    {
        $filePaths = [];

        if ($request->hasFile('featured')) {
            $files = $request->file('featured');

            foreach ($files as $file) {
                $destinationPath = '..\resources\featureds';
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $filePaths[] = $destinationPath . '/' . $filename;
            }
        }
        return $filePaths;
    }


    public function show($users, Salon $salon)
    {
        $users = SalonUsers::find($users);
        $salones_imagenes = SalonImage::where('salon_id', $salon->id)->paginate();
        $rentas = RentaSalon::where('salon_id', $salon->id)->get();
        return view('salones.show', compact('salon', 'salones_imagenes', 'users', 'rentas'));
    }



    public function edit($users, Salon $salon)
    {
        return view('salones.edit', compact('salon', 'users'));
    }

    public function update($users, Salon $salon, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $salon->name = $request->name;
        $salon->address = $request->address;
        $salon->capacity = $request->capacity;
        $salon->price = $request->price;
        $salon->description = $request->description;
        $salon->available = $request->has('available');
        $salon->save();

        return redirect()->route('salones.show', ['users' => $users, 'salon' => $salon])->with('success', 'Salón actualizado exitosamente.');
    }

    public function delete($user, $id)
    {
        Salon::findOrFail($id)->delete();
        RentaSalon::where('salon_id', $id)->delete();
        return redirect()->route('salones.index', $user)->with('success', 'Datos guardados correctamente');
    }

    public function mine($users)
    {
        $user = SalonUsers::find($users);
        $salones = Salon::where('owner', $users)->get();
        $salones_imagenes = SalonImage::paginate();
        return view('salones.mis-salones', compact('salones', 'salones_imagenes', 'user'));
    }

    public function goBack()
    {
        return back();
    }

}
