<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceitaIngrediente extends Model
{
    protected $fillable = [
        'medida',
        'quantidade',
        'id_alimento',
        'id_receitas',
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
        'vitaminaC'
      ];

      public $campos = [
          'medida',
          'quantidade',
          'id_alimento',
          'id_receitas',
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
          'vitaminaC'
      ];
}
