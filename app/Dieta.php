<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
  protected $fillable = [
    'nome',
  ];
  public $campos = [
    'id' => 'required',
    'nome' => 'required'
  ];
}
