<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $horario = Horario::with(['peliculas'])->get();
        return response()->json($horario);
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
           'horario' => 'required|string|between:2,100'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $horario = Horario::create($validator->validated());
        return response()->json([
            'horario' => $horario,
            'mensaje' => 'Horario creado correctamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sincronizarHorarioPelicula(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'horario_id' => 'required|integer',
            'pelicula_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $horario = Horario::find($request->get('horario_id'));
        $pelicula = Pelicula::find($request->get('pelicula_id'));

        if (empty($horario) || empty($pelicula)) {
            return response()->json([
                'mensaje' => 'El horario o el pelicula no existen'
            ], 404);
        }

        $id_pelicula = $request->get('pelicula_id');
        $horario->peliculas()->attach([$id_pelicula]);
        return response()->json([
            'mensaje'=> 'Asignación correcta'
        ],201);

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
