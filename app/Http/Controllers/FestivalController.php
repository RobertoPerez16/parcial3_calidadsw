<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Teatro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FestivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $festivales = Festival::with(['teatros'])->get();
        return response()->json($festivales);
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
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string|between:2,100',
            'duracion'=> 'required|string|between:1,9',
            'patrocinador'=> 'required|between:2,100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Ocurió un error',
                'errores'=> $validator->errors()
            ], 400);
        }

        $festival = Festival::create($validator->validated());
        return response()->json([
            'festival'=> $festival,
            'mensaje'=> 'Festival creado correctamente'
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        $festival = Festival::with(['teatros'])->find($id);
        if (empty($festival)) {
            return response()->json([
                'mensaje' => 'El festival que intenta buscar no se encuentra'
            ], 404);
        }
        return response()->json($festival);
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

    public function sincronizarFestivalTeatro (Request $request) {

        $validator = Validator::make($request->all(), [
            'festival_id' => 'required|integer',
            'teatro_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Teatro id o festival id incorrectos'
            ],400);
        }

        $festival = Festival::find($request->get('festival_id'));
        $teatro = Teatro::find($request->get('teatro_id'));

        if(empty($festival) || empty($teatro)) {
            return response()->json([
                'mensaje' => 'El teatro o el festival no existe'
            ], 404);
        }

        $festival->teatros()->attach([$request->get('teatro_id')]);

        return response()->json([
            'mensaje'=> 'Asignación correcta'
        ],201);

    }
}
