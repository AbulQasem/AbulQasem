<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(['status' => 'ok', 'data' => Profesor::all()], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profesor = new Profesor();

        $profesor->name = $request->name;
        $profesor->surname = $request->surname;
        $profesor->name_ar = $request->name_ar;
        $profesor->surname_ar = $request->surname_ar;
        $profesor->dni = $request->dni;
        $profesor->email = $request->email;
        $profesor->telefono = $request->telefono;
        $profesor->address = $request->direccion;
        $profesor->city = $request->city;
        $profesor->postalcode = $request->postalcode;
        $profesor->save();

        return response()->json(['code' => 200, 'message' => 'Profesor creado correctamente.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // Buscamos un padre por el id.
        $profesor = Profesor::find($id);


        // Si no existe padre devolvemos un error.
        if (!$profesor) {
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
            return response()->json(
                [
                    'errors' => array([
                        'code' => 404,
                        'message' => 'No se encuentra un padre con ese código.'
                    ]),
                    'id' => $id,
                ],
                404
            );
        }

        // Get all the groups
        $grupos = $profesor->grupos()->where('profesores_id', '=', $id)->get();


        return response()->json(
            [
                'status' => 'ok',
                'profesor' => $profesor,
                'grupos' => $grupos,

                200
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profesor = Profesor::find($id);

        // Si no existe padre devolvemos un error.
        if (!$profesor) {
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
            return response()->json(
                [
                    'errors' => array([
                        'code' => 404,
                        'message' => 'No se encuentra un padre con ese código.'
                    ]),
                    'id' => $id,
                ],
                404
            );
        }

        $profesor->name = $request->name;
        $profesor->surname = $request->surname;
        $profesor->name_ar = $request->name_ar;
        $profesor->surname_ar = $request->surname_ar;
        $profesor->dni = $request->dni;
        $profesor->telefono = $request->telefono;
        $profesor->email = $request->email;
        $profesor->address = $request->address;
        $profesor->city = $request->city;

        $profesor->update();

        return response()->json(
            [
                'status' => 'updated ok',
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
