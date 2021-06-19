<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Cliente;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoletaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $boletas = Boleta::with(['cliente', 'sala'])->get();
        return response()->json($boletas);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
           'cantidad' => 'required|integer',
           'tipo_boleta' => 'required|string|between:2,100',
           'cliente_id' => 'required|integer',
           'metodo_pago' => 'required|string|between:2,100',
           'precio' => 'required|string|between:2,100',
           'sala_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $cliente = Cliente::find($request->get('cliente_id'));
        $sala = Sala::find($request->get('sala_id'));

        if (empty($cliente) || empty($sala)) {
            return response()->json([
                'mensaje' => 'No existe el cliente o la sala que desea asignar'
            ], 400);
        }

        $boleta = Boleta::create($validator->validated());
        return response()->json([
            'Boleta creada' => $boleta,
            'mensaje' => 'Boleta creada correctamente'
        ]);
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
        //
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
