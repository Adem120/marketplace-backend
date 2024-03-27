<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\CategorieResource;
class ProduitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'code' => $this->code,
            'description' => $this->description,
            'marque' => $this->marque,
            'prix' => $this->prix,
            'quantite' => $this->quantite,
            'etat' => $this->etat,
            'prixLivr' => $this->prixLivr,
            'categorie' => new CategorieResource($this->categorie),
            'images' => $this->imageliste ? ImageResource::collection($this->imageliste) : null,
            'offres' => $this->offres ? OffreResource::collection($this->offres) : 'Pas d\'offres pour ce produit',
        ];
    }
}
