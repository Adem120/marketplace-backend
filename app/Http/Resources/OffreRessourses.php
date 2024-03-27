<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DateTime;

class OffreRessourses extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'pourcentage' => $this->pourcentage,
            'etat' => $this->etat == 1 ? true : false,
            'dateDebut' => $this->dateDebut,
            'dateFin' => $this->dateFin,
         
        ];
    }
}
