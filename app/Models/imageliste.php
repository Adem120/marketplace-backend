<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageliste extends Model
{
    use HasFactory;
    protected $fillable = ['nom','path','principale','produit_id'];
}
