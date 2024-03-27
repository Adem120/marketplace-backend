<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Http\Resources\CategorieResource;
class CategorieController extends Controller
{
    public function index(){
        $categories = Categorie::all();
        return response()->json(CategorieResource::collection($categories));
    }
    public function saveorupdate(Request $request){
        $categorie = Categorie::updateOrCreate(
            ['id' => $request->id],
            ['titre' => $request->titre, 'description' => $request->description,
            'user_id' => 1,
            ]
        );
        return response()->json($categorie);
    }
    public function show($id){
        $categorie = Categorie::find($id);
        return response()->json($categorie);
    }

    public function delete($id){
        $categorie = Categorie::find($id);
        $categorie->delete();
        return response()->json(['message' => 'Categorie supprimée avec succès']);
    }
}
