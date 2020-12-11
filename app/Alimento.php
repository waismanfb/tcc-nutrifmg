<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    protected $fillable = [
        'nome', 
        'umidade',
        'energiaKcal',
        'energiaKj',
        'proteina',
        'lipideos',
        'colesterol',
        'carboidrato',
        'fibraAlimentar',
        'cinzas',
        'calcio',
        'magnesio',
        'manganes',
        'fosforo',
        'ferro',
        'sodio',
        'potassio',
        'cobre',
        'zinco',
        'retinol',
        're',
        'rae',
        'tiamina',
        'riboflavina',
        'piridoxina',
        'niacina',
        'vitaminaC',
      ];   
}
