<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceitaIngrediente extends Model
{
    protected $fillable = [
        'nome', 
        'medida',
        'quantidade',
      ];      
}
