<?php

namespace App\Http\Controllers;

use Mockery\Exception;
use Illuminate\Http\Request;

use App\Models\Animal;

use App\Http\Requests\AnimalRequest;

class AnimalController extends Controller
{
    public function index()
    {
        return Animal::all();
    }

    public function store(AnimalRequest $request)
    {
        try {
            if($request->hasFile('imagem_animal') && $request->file('imagem_animal')->isValid()) {
                $request_image = $request->imagem_animal;
                $extension = $request_image->extension();
                $image_name = md5($request_image->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $request_image->move(public_path('ImagemAnimal'), $image_name);
            }

            Animal::create([
                'name' => $request -> nome_animal,
                'age' => $request -> idade_animal,
                'animal_breed' => $request -> raca_animal,
                'description' => $request -> descricao_animal,
                'sex' => $request -> sexo_animal,
                'animal_image' => $image_name
            ]);

            return response()->json([
                'message' => 'Animal cadastrado com sucesso.'
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao processar o cadastrar do animal.'
            ], 500);
        }
    }

    public function show($id)
    {
        $animal = Animal::find($id);
        if($animal) {
            return response()->json(
                $animal
            , 200);
        } else {
            return response()->json([
                'message' => 'Erro ao pesquisar por animal.'
            ], 400);
        }
    }

    public function update(AnimalRequest $request, $id)
    {
        try {
            $animal = Animal::find($id);
            if($animal) {
                $image_name = Animal::where('id', $id)->first()->animal_image;
                if($request->hasFile('imagem_animal') && $request->file('imagem_animal')->isValid()) {
                    $request_image = $request->imagem_animal;
                    $extension = $request_image->extension();
                    $image_name = md5($request_image->getClientOriginalName() . strtotime("now")) . "." . $extension;

                    $request_image->move(public_path('ImagemAnimal'), $image_name);
                }

                $animal->update([
                    'name' => $request -> nome_animal,
                    'age' => $request -> idade_animal,
                    'animal_breed' => $request -> raca_animal,
                    'description' => $request -> descricao_animal,
                    'sex' => $request -> sexo_animal,
                    'animal_image' => $image_name
                ]);

                return response()->json([
                    'message' => 'Dados do animal atualizado com sucesso.'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Erro ao atualizar as informações do animal.'
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao processar a atualização dos dados do animal.'
            ], 500);
        }
    }

    public function destroy($id)
    {
        if(Animal::destroy($id)) {
            return response()->json([
                'message' => 'Animal deletado com sucesso.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Erro ao deletar as informações do animal.'
            ], 400);
        }
    }
}
