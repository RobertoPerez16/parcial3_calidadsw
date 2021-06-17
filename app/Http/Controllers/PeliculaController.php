<?php

namespace App\Http\Controllers;


use App\Models\Pelicula;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $peliculas = Pelicula::with(['salas', 'horarios'])->get();
        return response()->json($peliculas);

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
            'nombre' => 'required|string|between:2,100',
            'duracion' => 'required|string|between:2,100',
            'creditos' => 'required|string|between:2,100',
            'director' => 'required|string|between:2,100',
            'pais' => 'required|string|between:2,100',
            'banda_anuncio' => 'required|string|between:2,100'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $pelicula = Pelicula::create($validator->validated());
        return response()->json([
            'pelicula' => $pelicula,
            'mensaje' => 'Pelicula creada correctamente'
        ], 201);

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function sincronizarPeliculaSala(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'sala_id' => 'required|integer',
            'pelicula_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $pelicula = Pelicula::find($request->get('pelicula_id'));
        $sala = Sala::find($request->get('sala_id'));

        if (empty($pelicula) || empty($sala)) {
            return response()->json([
                'mensaje' => 'La pelicula o la sala no existen'
            ], 404);
        }

        $id_sala = $request->get('sala_id');

        $pelicula->salas()->attach([$id_sala]);
        return response()->json([
            'mensaje'=> 'Asignación correcta'
        ],201);
    }

}
