<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Animal;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Animal::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Animal::create($request->all())) {[
            return response()->json([
                'message' => 'Animal cadastrado com sucesso.'
            ], 201);
        ]} else {
            return response()->json([
                'message' => 'Erro ao cadastrar animal.'
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $animal = Animal::find($id);
        if($animal) {
            return $animal;
        } else {
            return response()->json([
                'message' => 'Erro ao pesquisar por animal.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $animal = Animal::find($id);
        if($animal) {
            $animal->update($request->all());
            return $animal;
        } else {
            return response()->json([
                'message' => 'Erro ao atualizar as informações do animal.'
            ], 404);
        }
        // return Animal::where('id', $id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Animal::destroy($id)) {
            return response()->json([
                'message' => 'Animal deletado com sucesso.'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Erro ao deletar as informações do animal.'
            ], 404);
        }
    }
}
