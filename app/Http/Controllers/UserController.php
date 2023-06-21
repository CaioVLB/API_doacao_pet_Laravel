<?php

namespace App\Http\Controllers;

use Mockery\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Http\Controllers\ConsultZipCodeController;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function store(UserRequest $request)
    {
        try {
            $convert_email = strtolower($request->email_usuario);
            $hash_password = Hash::make($request->senha_usuario);

            User::create([
                'name' => $request -> nome_usuario,
                'cpf' => $request -> cpf_usuario,
                'email' => $convert_email,
                'password' => $hash_password,
                'location' => $request -> cep_usuario
            ]);

            return response()->json([
                'message' => 'Usuário cadastrado com sucesso.',
                'free_access' => true
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao processar o cadastro do usuário.'
            ], 500);
        }
    }

    public function show($id)
    {
        $user = User::find($id); // eloquent find procura pelo id da chave primaria, caso queria procurar por outro campo, deverá usar o where
        if($user) {

            if($user->location) {
                $location = (new ConsultZipCodeController())->consultZipCode($user->location);
                $user->location = $location;
            }

            return response()->json(
                $user
            , 200);
        } else {
            return response()->json([
                'message' => 'Erro ao pesquisar por usuário.'
            ], 400);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $convert_email = strtolower($request->email_usuario);
            $user = User::find($id);
            if($user) {
                $user->update([
                    'name' => $request -> nome_usuario,
                    'cpf' => $request -> cpf_usuario,
                    'email' => $convert_email,
                    'location' => $request -> cep_usuario
                ]);

                return response()->json([
                    'message' => 'Dados do usuário atualizado com sucesso.'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Erro ao atualizar dados do usuário.'
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao processar a atualização dos dados do usuário.'
            ], 500);
        }
    }

    public function destroy($id)
    {
        if(User::destroy($id)) {
            return response()->json([
                'message' => 'Usuário deletado com sucesso.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Erro ao deletar o usuário.'
            ], 400);
        }
    }
}
