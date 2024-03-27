<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Http\Resources\ProduitResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ImageResource;
use App\Models\Categorie;
use App\Models\imageliste;
use App\Events\PodcastProcessed;

class ProduitController extends Controller
{
public function getallProduit(){
        $produits = Produit::all();
       
       
        return response()->json(ProduitResource::collection($produits));
    }
public function saveProduit(Request $request){

   try {
       
        $produit = new Produit();
        $produit->titre = $request->titre;
        $produit->code = $request->code;
        $produit->description = $request->description;
        $produit->marque = $request->marque;
        $produit->prix = $request->prix;
        $produit->quantite = $request->quantite;
        $produit->prixLivr = $request->prixLivr;
        $produit->categorie_id = $request->categorie_id;
        $produit->user_id = 1;
        $produit->offre_id =null;
                $produit->save();
        
        $image = $request->image; 
          if($request->hasFile('image')){
              foreach($image as $img){
                $photo = new imageliste();
                  $photo->produit_id = $produit->id;
                  $imgname =Str::random(20).'.'.$img->getClientOriginalExtension();
                  $photo->nom = $imgname;
                  $photo->path=Storage::url('public/images/'.$imgname);
                  if($img->getClientOriginalName()==$request->principale){
                    $photo->principale = 1;
                }
                else{
                    $photo->principale = 0;
                }                   
                 $img->storeAs('public/images',$imgname);
                    
                $photo->save();
                   
       
              }
             
          
              }
            
      
         
          }
      
          catch (\Exception $e) {
  
              return response()->json([
                  'message' => 'product not added',
                  'error' => $e->getMessage(),
                 
              ], 400);
          }
          return response()->json([
              'message' =>'product ajouter',
             
             
              
          ], 200);
      }
      public function getImage($imageName)
      {
          $path = storage_path('public/images/' . $imageName);
      
          if (!file_exists($path)) {
              abort(404);
          }
      
          $file = file_get_contents($path);
          $type = mime_content_type($path);
      
          return response($file, 200)->header('Content-Type', $type);
      }
public function getProduit($id){
        $produit = Produit::find($id);
        return response()->json(ProduitResource::make($produit));
         }

    public function updateProduit(Request $request, $id){
        try{
        $image = $request->file('image');
        $produit = Produit::find($id);
        $produit->titre = $request->titre;
        $produit->code = $request->code;
        $produit->description = $request->description;
        $produit->marque = $request->marque;
        $produit->prix = $request->prix;
        $produit->quantite = $request->quantite;
        $produit->etat = $request->etat;
        $produit->prixLivr = $request->prixLivr;
        $produit->categorie_id = $request->categorie_id;
        $produit->user_id = 1;
        $produit->save();        
       
         $image1[] = Imageliste::where('produit_id',$id)->get();
        foreach($image1[0] as $img){
            Storage::delete('public/images/'.$img->nom);
     }
        $image1 = Imageliste::where('produit_id',$id)->delete();
        
            foreach($request->image as $img){
               
                $photo = new imageliste();
                $photo->produit_id = $produit->id;
                $imgname = $img->getClientOriginalName();
                $photo->nom = $imgname;
                $photo->path=Storage::url('public/images/'.$imgname.'update');
    
                if($img->getClientOriginalName()==$request->principale){
                    $photo->principale = 1;
                }
                else{
                    $photo->principale = 0;
                }   
                  $img->storeAs('public/images',$imgname);
                  $photo->save();
    
            }
        
            
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => 'product not updated',
                'error' => $e->getMessage(),
            ], 400);
        }
        return response()->json([
          'image'=>$request->hasFile('image'),
         
            'message' => 'product updated successfully'
        ], 200);
    }
    public function deleteProduit($id){
        $produit = Produit::find($id);
        $produit->delete();
        return response()->json([
            'message' => 'product deleted successfully'
        ], 200);
    }
    public function validerProduit(){
        
        $message = 'product validated successfully';
        
        event(new PodcastProcessed($message));

        
       
    }
}

