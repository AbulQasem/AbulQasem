<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Padre;

class PadreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status' => 'ok', 'data' => Padre::all()], 200);
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
        //
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
        $padre = Padre::find($id);
        $alumnos = $padre->alumnos()->where('padres_id', '=', $id)->get();
        $pagos = $padre->pagos()->where('padres_id', '=', $id)->get();


        // Si no existe padre devolvemos un error.
        if (!$padre) {
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

        return response()->json(
            [
                'status' => 'ok',
                'padre' => $padre,
                'hijos' => $alumnos,
                'pagos' => $pagos
            ],
            200
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
        $padre = Padre::find($id);

        // Si no existe padre devolvemos un error.
        if (!$padre) {
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

        $padre->name = $request->name;
        $padre->surname = $request->surname;
        $padre->name_ar = $request->name_ar;
        $padre->surname_ar = $request->surname_ar;
        $padre->dni = $request->dni;
        $padre->telefono = $request->telefono;
        $padre->email = $request->email;
        $padre->address = $request->address;
        $padre->city = $request->city;
        $padre->postalcode = $request->postalcode;
        $padre->Matricula = $request->Matricula;
        $padre->Descuento = $request->Descuento;
        $padre->update();

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
        $padre = Padre::find($id);

        // Si no existe devolvemos un error.
        if (!$padre) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra padre.'])], 404);
        }

        // Find asociated 
        $alumnos = $padre->alumnos;

        if (sizeof($alumnos) > 0) {
            // foreach($alumnos as $alumno) {
            //     $alumno->delete();
            // }        
            return response()->json(['code' => 409, 'message' => 'No se puede eliminar'], 409);
        }

        // Procedemos por lo tanto a eliminar.
        $padre->delete();

        return response()->json(['code' => 204, 'message' => 'Se ha eliminado correctamente.'], 204);
    }
}
