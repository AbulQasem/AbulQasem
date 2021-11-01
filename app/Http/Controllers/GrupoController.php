<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = DB::table('grupos')
            ->join('profesores', 'grupos.profesores_id', "=", "profesores.id")
            ->orderBy('grupos.nivel')
            ->select('grupos.*', 'profesores.name', 'profesores.surname')
            ->get();

        return response()->json(['status' => 'ok', 'data' => $grupos], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grupo = new Grupo();

        $grupo->horario = $request->input('horario');
        $grupo->dia = $request->input('dia');
        $grupo->aula = $request->input('aula');
        $grupo->profesores_id = $request->input('profesores_id');
        $grupo->nivel = $request->input('nivel');
        $grupo->save();

        return response()->json(['code' => 200, 'message' => 'Grupo creado correctamente.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = Grupo::find($id);
        $alumnos = $grupo->alumnos()->where('grupos_id', '=', $id)
            ->leftJoin('padres', "padres.id", "=", "alumnos.padres_id")
            ->select('alumnos.*', 'padres.telefono')
            ->get();

        $profesor = $grupo->profesores()->get();


        return response()->json(
            [
                'status' => 'ok',
                'alumnos' => $alumnos,
                'grupo' => $grupo,
                'profesor' => $profesor
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
        $grupo = Grupo::find($id);

        // Si no existe padre devolvemos un error.
        if (!$grupo) {
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

        $grupo->horario = $request->horario;
        $grupo->dia = $request->dia;
        $grupo->aula = $request->aula;
        $grupo->nivel = $request->nivel;

        $grupo->profesores_id = $request->profesores_id;

        $grupo->update();

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
        $grupo = Grupo::find($id);

        // Si no existe devolvemos un error.
        if (!$grupo) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra el pago.'])], 404);
        }


        // Procedemos por lo tanto a eliminar.
        $grupo->delete();

        return response()->json(['code' => 204, 'message' => 'Se ha eliminado correctamente.'], 204);
    }
}
