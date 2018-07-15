<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gasto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;


class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $gastosAll = Gasto::all();
        return view('gastos.index')->with('gastos',$gastosAll);
    }

    public function getAll(){
        $gastosAll = Gasto::all();
        $response = array('data');
        foreach ($gastosAll as $gastoTmp ){
            $dateFecha = date('Y-m-d',strtotime($gastoTmp->fecha));
            $botones =
                '<button type="button" class="btn btn-raised btn-sm btn-warning" onclick="changeGasto('.$gastoTmp->id.')">Modificar</button> '.
                '<button type="button" class="btn btn-raised btn-sm btn-danger" onclick="deleteGasto('.$gastoTmp->id.')">Borrar</button>';
            $response['data'][] = array(
                $gastoTmp->titulo,
                $gastoTmp->descripcion,
                $gastoTmp->piso,
                $dateFecha,
                $gastoTmp->responsable,
                $gastoTmp->created_at->format('Y-m-d'),
                $botones
            );
        }
        echo json_encode($response);
        exit();
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
        $return = array('status'=>false);
        $newGasto = new Gasto();
        $newGasto->titulo = $request->titulo;
        $newGasto->piso = $request->piso;
        $newGasto->descripcion = $request->descripcion;
        $newGasto->fecha = $request->fecha;
        $newGasto->responsable = $request->responsable;
        $newGasto->creado_por = Auth::user()->id;
        if($newGasto->save()){
            $return['status'] = true;
        }
        echo json_encode($return);
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $return = array('status'=>false);
        $gasto = Gasto::find($id);
        if($gasto){
            $return['status'] = true;
            $dateFecha = date('Y-m-d',strtotime($gasto->fecha));
            $gasto->fecha = $dateFecha;
            $return['gasto'] = $gasto;
        }
        echo json_encode($return);
        exit();
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
        $return = array('status'=>false);
        $gasto = Gasto::find($id);
        if($gasto){
            $gasto->titulo = $request->titulo;
            $gasto->piso = $request->piso;
            $gasto->descripcion = $request->descripcion;
            $gasto->fecha = $request->fecha;
            $gasto->responsable = $request->responsable;
            $gasto->modificado_por = Auth::user()->id;
            if($gasto->save()){
                $return['status'] = true;
            }
        }

        echo json_encode($return);
        exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $return = array('status'=>false);
        $gasto = Gasto::find($id);
        if($gasto){
            $gasto->borrado_por = Auth::user()->id;
            if($gasto->save()){
                if($gasto->delete()){
                    $return['status'] = true;
                }
            }
        }
        echo json_encode($return);
        exit;

    }
}
