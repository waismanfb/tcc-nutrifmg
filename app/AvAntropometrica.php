<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvAntropometrica extends Model
{
  protected $fillable = [
    'id_paciente', 'data','peso','altura','pct','meses','classificacaoImcIdade','scoreImcIdade','classificacaoEstIdade','scoreEstIdade',
  ];
  protected $hidden = [
    'id_paciente',
  ];
}
