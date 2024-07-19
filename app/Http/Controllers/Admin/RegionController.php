<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regiones = Region::all();
        return view('admin.regiones.index',compact('regiones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.regiones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'region' => ['required','string','max:255'],
            'sede' => ['required','string','max:255'],
        ]);

        $region = new Region();

        // # Asignar el valor de los campo convertido a mayúsculas usando mb_strtoupper
        // # 'UTF-8' especifica la codificación de caracteres multibyte que estamos utilizando
        $region->region = mb_strtoupper($request->input('region'),'UTF-8') ;
        $region->sede = mb_strtoupper($request->input('sede'),'UTF-8') ;

        #Guardamos el nuevo registro
        $region->save();

        #Retornamos a la vista principal
        return redirect()->route('region.index')->with('success_region','Región guardada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $region = Region::find($id);

        // return $region->sede;
        return view('admin.regiones.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'region' => ['required','string','max:255'],
            'sede' => ['required','string','max:255'],
        ]);

        $region = Region::find($id);

        // # Asignar el valor de los campo convertido a mayúsculas usando mb_strtoupper
        // # 'UTF-8' especifica la codificación de caracteres multibyte que estamos utilizando
        $region->region = mb_strtoupper($request->input('region'),'UTF-8') ;
        $region->sede = mb_strtoupper($request->input('sede'),'UTF-8') ;

        #Guardamos el nuevo registro
        $region->update();

        #Retornamos a la vista principal
        return redirect()->route('region.index')->with('update_region','Región actualizada');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Region::find($id)->delete();

        #Retornamos a la vista principal
        return redirect()->route('region.index')->with('delete_region','Región actualizada');        
    }
}
