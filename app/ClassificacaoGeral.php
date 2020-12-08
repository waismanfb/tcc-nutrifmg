<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassificacaoGeral extends Model
{
  protected $fillable = [
    'id_paciente', 'data','peso','altura','pct','meses','classificacaoImcIdade','scoreImcIdade','classificacaoEstIdade','scoreEstIdade',
  ];
  protected $hidden = [
    'id_paciente',
  ];
  protected $primaryKey = 'id_paciente';
}
