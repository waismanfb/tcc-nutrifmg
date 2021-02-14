<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Receita extends Model
{
    protected $fillable = [
        'nome',
        'quantidadeTotal',
        'quantidadePorcao',
      ];

      //gera um id customizado para as receitas comecando de 10000
      public static function boot()
        {
            parent::boot();
            self::creating(function ($model) {
                $model->id = IdGenerator::generate(['table' => 'receitas',
                'length' => 6, 'prefix' => '1000']);
            });
        }
}
