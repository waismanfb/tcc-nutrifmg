<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    protected $fillable = [
        'nome', 
        'energiaKcal',
        'proteina',
        'lipideos',
        'carboidrato',
      ];   
}
