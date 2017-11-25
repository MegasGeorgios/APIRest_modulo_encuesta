<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     public function store(Request $request, $id_pregunta)
     {
    //    if (!$request->get('texto_libre') || !$request->get('valoracion') || !$request->get('opciones'))
    //    {
    //        return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'code'=>422],422);
    //    }

    //    $encuesta= Encuesta::find($id_encuesta);
    //    if(!$encuesta){
    //      return response()->json(['mensaje'=>'No se encontraro la encuesta', 'code'=>404],404);
    //    }

    //    Pregunta::create([
    //      'texto_libre' => $request->get('texto_libre'),
    //      'aclaratoria' => $request->get('valoracion'),
    //      'tipo_respuesta' => $request->get('opciones'),
    //      'id_pregunta' => $id_pregunta
    //    ]);
        $data = $request->json()->all();
        $output = new Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln("<info>my message</info>");
        $output->writeln($data);
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
