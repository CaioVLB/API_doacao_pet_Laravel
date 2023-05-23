<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(User::create($request->all())) {[
            return response()->json([
                'message' => 'Usuário cadastrado com sucesso.'
            ], 201);
        ]} else {
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
        $user = User::find($id); // eloquent find procura pelo id da chave primaria, caso queria procurar por outro campo, deverá usar o where
        if($user) {
            return $user;
        } else {
            return response()->json([
                'message' => 'Erro ao pesquisar por usuário.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if($user) {
            $user->update($request->all());
            return $user;
        } else {
            return response()->json([
                'message' => 'Erro ao atualizar dados do usuário.'
            ], 404);
        }
        // return User::where('id', $id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(User::destroy($id)) {
            return response()->json([
                'message' => 'Usuário deletado com sucesso.'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Erro ao deletar o usuário.'
            ], 404);
        }
    }
}
