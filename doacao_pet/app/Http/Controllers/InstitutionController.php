<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Institution;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Institution::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Institution::create($request->all())) {
            return response()->json([
                'message' => 'Instituição cadastrado com sucesso.'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Erro ao cadastrar usuário.'
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $institution = Institution::find($id);
        if($institution) {
            return $institution;
        } else {
            return response()->json([
                'message' => 'Erro ao pesquisar por uma instituição.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $institution = Institution::find($id);
        if($institution) {
            $institution->update($request->all());
            return $institution;
        } else {
            return response()->json([
                'message' => 'Erro ao atualizar dados da instituição.'
            ], 404);
        }
        // return Institution::where('id', $id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Institution::destroy($id)) {
            return response()->json([
                'message' => 'Instituição deletada com sucesso.'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Erro ao deletar a instituição.'
            ], 404);
        }
    }
}
