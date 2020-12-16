<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DietasPaciente extends Model
{
  protected $fillable = [
    'id', 'id_paciente', 'id_alimento', 'id_dieta', 'quantidade', 'data_coleta',
  ];
  protected $hidden = [
    'id',
  ];
  protected $primaryKey = 'id';
}
