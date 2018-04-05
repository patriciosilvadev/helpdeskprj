<?php

namespace App\Http\Controllers\APIControllers;

use App\Models\ChamadoCategoria;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ChamadoCategoriaCollection;
use App\Http\Resources\ChamadoCategoriaResource;


class ChamadoCategoriaAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = (new ChamadoCategoria)->newQuery();

        if( $request->filled("nome") ){
            $query->where("nome", "like", "%" . $request->input("nome") . "%");
        }

        if( $request->filled("codigo") ){
            $query->where("codigo", "like", "%" . $request->input("codigo") . "%");
        }

        if( $request->filled("search.value") ){
            $query->where("nome", "like", "%" . $request->input("search.value") . "%");
            $query->orWhere("codigo", "like", "%" . $request->input("search.value") . "%");
        }

        if( $request->filled("status") ){
            $query->whereIn("status", $request->input("status"));
        }

        if( $request->filled("organizacao_id") ){
            $query->whereIn("organizacao_id", $request->input("organizacao_id"));
        }

        if( $request->filled("order.0.column") && $request->filled("order.0.dir") ){

            $columns = $request->input('columns');

            foreach ($request->order as $order) {
                $query->orderBy($columns[$order['column']]['data'],$order['dir']);
            }
        }

        if( $request->filled("length") && $request->filled("start") ){
            $query->take($request->input("length"));
            $query->skip($request->input("start"));
        }

        return new ChamadoCategoriaCollection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chamadoCategoria = new ChamadoCategoria();
        $chamadoCategoria->nome;
        $chamadoCategoria->codigo;
        $chamadoCategoria->status;
        $resultado = $chamadoCategoria->save();

        if($resultado){
            return response()->json(null, 204);
        }else{
            return response()->json(["msg"=>"Houve um erro desconhecido no cadastro do registro."], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChamadoCategoria  $chamadoCategoria
     * @return \Illuminate\Http\Response
     */
    public function show(ChamadoCategoria $chamadoCategoria)
    {
        return new ChamadoCategoriaResource($chamadoCategoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChamadoCategoria  $chamadoCategoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChamadoCategoria $chamadoCategoria)
    {
        $chamadoCategoria->nome;
        $chamadoCategoria->codigo;
        $chamadoCategoria->status;
        $resultado = $chamadoCategoria->save();

        if($resultado){
            return response()->json(null, 204);
        }else{
            return response()->json(["msg"=>"Houve um erro desconhecido na atualização do registro."], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChamadoCategoria  $chamadoCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChamadoCategoria $chamadoCategoria)
    {
        $chamadoCategoria->delete();
        return response()->json(null, 204);
    }
}
