<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Institution;

class LoginController extends Controller
{
    public function auth(Request $request) {

        // $credenciais = $request->validate([
        //     'email' => ['required', 'email', 'unique'], //TODO: Colocar esse 'unique' e a mensagem lá no momento de cadastrar
        //     'senha' => ['required'],

        //     'email.required' => 'O preenchimento do campo email é obrigatório.',
        //     'email.email' => 'Digite um e-mail válido.',
        //     'email.unique' => 'E-mail já está em uso.',
        //     'senha.required' => 'O preenchimento do campo senha é obrigatório.'
        // ]);

        $senha_user = User::where('email', $request->email)->first(['email', 'password']);
        $senha_institution = Institution::where('email', $request->email)->first(['email', 'password']);

        if($senha_user || $senha_institution) {
            if(Hash::check($request->senha, $senha_user->password) || Hash::check($request->senha, $senha_institution->password)) { //TODO:verificar com o luiz o porque de dar erro quando a confição dá 'null'
                return response()->json([
                    'message' => 'Autenticado efetuada com sucesso.',
                    'free_access' => true
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Senha inválida.'
                ], 400);
            }
        } else {
            return response()->json([
                'message' => 'Acesso negado.'
            ], 400);
        }
    }

    public function changePassword(Request $request) {
        $verify_email_user = User::where('email', $request->email)->first('id');
        $verify_email_institution = Institution::where('email', $request->email)->first('id');

        if($verify_email_user) {
            $new_password = Hash::make($request->senha);
            User::where('id', $verify_email_user->id)->update([
                'password' => $new_password
            ]);

            return response()->json([
                'message' => 'Senha alterada com sucesso.',
            ], 200);

        } elseif ($verify_email_institution) {
            $new_password = Hash::make($request->senha);
            Institution::where('id', $verify_email_institution->id)->update([
                'password' => $new_password
            ]);

            return response()->json([
                'message' => 'Senha alterada com sucesso.',
            ], 200);

        } else {
            return response()->json([
                'message' => 'E-mail inválido.'
            ], 400);
        }
    }
}

