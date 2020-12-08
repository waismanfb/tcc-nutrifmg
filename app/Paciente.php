<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
  protected $fillable = [
    'nome', 'sexo','dataNascimento','anosEstudo','renda','curso','numPessoasCasa','moradia','numRefeicoes',
  ];
  protected $hidden = [
    'numRefeicoes',
  ];
  public $campos = [
    'nome' => 'required|min:3|max:100',
    'anosEstudo' => 'required|max:30|numeric',
    'renda' => 'required',
    'numPessoasCasa' => 'required|numeric|max:20',
    'dataNascimento' => 'required',
  ];
}
