<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response()->json(['status' => 'ok', 'data' => Alumno::all()], 200);

        $alumnos = DB::table('alumnos')
        ->leftJoin('grupos', 'grupos.id', "=", "alumnos.grupos_id")
        ->select('alumnos.*', 'grupos.nivel', "grupos.horario", "grupos.dia")
        ->get();

    return response()->json(['status' => 'ok', 'data' => $alumnos], 200);
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
        //
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
        $alumno = Alumno::find($id);

        // Si no existe padre devolvemos un error.
        if (!$alumno) {
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

        $alumno->name = $request->name;
        $alumno->surname = $request->surname;
        $alumno->name_ar = $request->name_ar;
        $alumno->surname_ar = $request->surname_ar;
        $alumno->grupos_id = $request->grupos_id;
        $alumno->update();

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
