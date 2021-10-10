<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = DB::table('pagos')
            ->leftJoin('padres', 'padres.id', "=", "pagos.padres_id")
            ->select('pagos.*', 'padres.name', 'padres.surname')
            ->get();

        return response()->json(['status' => 'ok', 'data' => $pagos], 200);
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
        $pago = new Pago();
        $pago->cantidad = $request->cantidad;
        $pago->user_id = $request->user_id;
        $pago->padres_id = (int) $request->padre_id;

        $pago->save();

        return response($request, 200);
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
        $pago = Pago::find($id);

        // Si no existe padre devolvemos un error.
        if (!$pago) {
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

        $pago->cantidad = $request->cantidad;
        $pago->update();

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
        $pago = Pago::find($id);

        // Si no existe devolvemos un error.
        if (!$pago) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra el pago.'])], 404);
        }


        // Procedemos por lo tanto a eliminar.
        $pago->delete();

        return response()->json(['code' => 204, 'message' => 'Se ha eliminado correctamente.'], 204);
    }
}
