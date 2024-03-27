<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['titre','description','prix','quantite','etat','marque','code','prixLivr','categorie_id','user_id','offre_id'];
    public function categorie(){
        return $this->belongsTo(categorie::class);
    }
    public function imageliste(){
        return $this->hasMany(imageliste::class);
    }
    public function offre(){
        return $this->hasMany(Offre::class);
    }
}
