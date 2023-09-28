<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarefas = Tarefa::all();

        return view('tarefa', compact('tarefas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-tarefa');
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validador = Validator::make($request->all(),[
            'titulo'=> 'required'
        ]);

        if($validador->fails()){
            return redirect()->route('tarefa.create')->withErrors($validador);
        }

        Tarefa::create([
            'titulo' => $request->input('titulo'),
            'descricao' => $request->input('descricao')
        ]);

        return redirect()->route('tarefa.index')->with('success', 'Tarefa criada com sucesso!');
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
        $tarefa = Tarefa::find($id);
        return view('edit-tarefa',["tarefa"=>$tarefa]);
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
        $validador = Validator::make($request->all(),[
            'titulo'=> 'required',
            'descricao' => 'required'
        ]);
        if($validador->fails()){
            return redirect()->route('tarefa.edit',$id)->withErrors($validador);
        }

        $tarefa = Tarefa::find($id);

        $tarefa->titulo = $request->input('titulo');
        $tarefa->descricao = $request->input('descricao');
        $tarefa->concluido = $request->input('concluido');
        $tarefa->save();
        return redirect()->route('tarefa.index')->with('success', 'Tarefa atualizada com sucesso');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        Tarefa::destroy($id);
        return redirect()->route('tarefa.index')->with('success', 'Tarefa excluida com sucesso');
    }
}
