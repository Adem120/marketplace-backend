<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ImageResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {                    
     $base64 = base64_encode(Storage::get('public/images/' . $this->nom));
       $type = Storage::mimeType('public/images/' . $this->nom);
        //afficher base64 in console
      
  
    // Proceed with returning the data
    return [
        'id' => $this->id,
        'nom' => $this->nom,
        'path' => $base64, 
        'type' => $type,
        'principale' => $this->principale,
    ];
}
}
