<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    protected $fillable = [
        'nome', 
        'totalEnergiaKcal',
        'totalProteina',
        'totalLipideos',
        'totalCarboidrato',
      ];  
}
