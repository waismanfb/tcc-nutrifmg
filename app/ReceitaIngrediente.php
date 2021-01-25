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
        'energiaKcal',
        'proteina',
        'lipideos',
        'carboidrato'
      ];

      public $campos = [
          'id',
          'medida',
          'quantidade',
          'id_alimento',
          'id_receitas',
          'energiaKcal',
          'proteina',
          'lipideos',
          'carboidrato'
      ];
}
