<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre;
use App\Http\Resources\OffreRessourses;

class OffreController extends Controller
{
    public function getallOffre(){
        $offres = Offre::all();
        return response()->json(OffreRessourses::collection($offres));

     
    }
    public function getOffre($id){
        $offre = Offre::find($id);
        if(is_null($offre)){
            return response()->json(['message' => 'Offre non trouvé'], 404);
        }
        return response()->json(new OffreRessourses($offre), 200);
    }
    public function createOffre(Request $request){
        $offre = new Offre();
        $offre->titre = $request->titre;
        $offre->pourcentage = $request->pourcentage;
        $offre->etat ='0';
        $offre->dateDebut = new \DateTime();
        $offre->dateFin = new \DateTime();
        $offre->user_id = 1;
        $offre->save();
        return response()->json(new OffreRessourses($offre), 201);
    }
    public function updateOffre(Request $request, $id){
        $offre = Offre::find($id);
        if(is_null($offre)){
            return response()->json(['message' => 'Offre non trouvé'], 404);
        }
        $offre->update($request->all());
        return response()->json(new OffreRessourses($offre), 200);
    }
    public function deleteOffre($id){
        $offre = Offre::find($id);
        if(is_null($offre)){
            return response()->json(['message' => 'Offre non trouvé'], 404);
        }
        $offre->delete();
        return response()->json(null, 204);
    }
}
