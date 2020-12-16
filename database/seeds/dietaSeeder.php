<?php

use Illuminate\Database\Seeder;
use App\Dieta;

class dietaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dieta::create([
          'nome' => 'Café da Manhã',
        ]);
        Dieta::create([
          'nome' => 'Lanche da Manhã',
        ]);
        Dieta::create([
          'nome' => 'Almoço',
        ]);
        Dieta::create([
          'nome' => 'Lanche da Tarde',
        ]);
        Dieta::create([
          'nome' => 'Jantar',
        ]);
        Dieta::create([
          'nome' => 'Lanche da Noite',
        ]);
    }
}
