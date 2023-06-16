<?php

namespace App\Http\Controllers;

use Mockery\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Institution;

use App\Http\Controllers\ConsultZipCodeController;

class InstitutionController extends Controller
{
    public function index()
    {
        return Institution::all();
    }

    public function store(Request $request)
    {
        try {
            if($request->hasFile('imagem_instituicao') && $request->file('imagem_instituicao')->isValid()) {
                $request_image = $request->imagem_instituicao;
                $extension = $request_image->extension();
                $image_name = md5($request_image->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $request_image->move(public_path('ImagemInstituicao'), $image_name);
            }

            $hash_password = Hash::make($request->senha_instituicao);

            Institution::create([
                'company_name' => $request -> nome_instituicao,
                'cnpj' => $request -> cnpj_instituicao,
                'description' => $request -> descricao_instituicao,
                'location' => $request -> cep_instituicao,
                'institution_image' => $image_name,
                'bank_name' => $request -> banco_instituicao,
                'agency' => $request -> agencia_instituicao,
                'current_account' => $request -> conta_corrente_instituicao,
                'pix_key' => $request -> pix_instituicao,
                'corporate_name' => $request -> razao_social_instituicao,
                'email' => $request -> email_instituicao,
                'password' => $hash_password
            ]);

            return response()->json([
                'message' => 'Instituição cadastrada com sucesso.'
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao processar o cadastro da instituição.'
            ], 500);
        }
    }

    public function show($id)
    {
        $institution = Institution::find($id);
        if($institution) {

            if($institution->location) {
                $location = (new ConsultZipCodeController())->consultZipCode($institution->location);
                $institution->location = $location;
            }

            return response()->json(
                $institution
            , 200);
        } else {
            return response()->json([
                'message' => 'Erro ao pesquisar por uma instituição.'
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $institution = Institution::find($id);
            if($institution) {
                $image_name = Institution::where('id', $id)->first()->institution_image;
                if($request->hasFile('imagem_instituicao') && $request->file('imagem_instituicao')->isValid()) {
                    $request_image = $request->imagem_instituicao;
                    $extension = $request_image->extension();
                    $image_name = md5($request_image->getClientOriginalName() . strtotime("now")) . "." . $extension;

                    $request_image->move(public_path('ImagemInstituicao'), $image_name);
                }

                $institution->update([
                    'company_name' => $request -> nome_instituicao,
                    'cnpj' => $request -> cnpj_instituicao,
                    'description' => $request -> descricao_instituicao,
                    'location' => $request -> cep_instituicao,
                    'institution_image' => $image_name,
                    'bank_name' => $request -> banco_instituicao,
                    'agency' => $request -> agencia_instituicao,
                    'current_account' => $request -> conta_corrente_instituicao,
                    'pix_key' => $request -> pix_instituicao,
                    'corporate_name' => $request -> razao_social_instituicao,
                    'email' => $request -> email_instituicao
                ]);

                return response()->json([
                    'message' => 'Dados da instituição atualizado com sucesso.'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Erro ao atualizar dados da instituição.'
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao processar a atualização dos dados da instituição.'
            ], 500);
        }
    }

    public function destroy($id)
    {
        if(Institution::destroy($id)) {
            return response()->json([
                'message' => 'Instituição deletada com sucesso.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Erro ao deletar a instituição.'
            ], 400);
        }
    }
}
