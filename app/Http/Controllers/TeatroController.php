<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Teatro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeatroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $teatro = Teatro::with(['sala'])->get();
        return response()->json($teatro);
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
            'sala_id' => 'required|integer'
        ]);

        $sala = Sala::find($request->get('sala_id'));
        if (empty($sala)) {
            return response()->json([
                'mensaje' => 'La sala no existe'
            ], 400);
        }

        $teatro = Teatro::create($validator->validated());
        return response()->json([
            'teatro' => $teatro,
            'mensaje' => 'Teatro creado correctamente'
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
