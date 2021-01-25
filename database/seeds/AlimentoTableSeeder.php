<?php

use Illuminate\Database\Seeder;
use App\Alimento;

class AlimentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alimentos')->insert([

            [
                'nome' => 'Arroz, integral, cozido',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 124,
                'proteina' => 2.6,
                'lipideos' => 1.0,
                'carboidrato' => 25.8,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Arroz, integral, cru',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 360,
                'proteina' => 7.3,
                'lipideos' => 1.9,
                'carboidrato' => 77.5,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Arroz, tipo 1, cozido ',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 128,
                'proteina' => 2.5,
                'lipideos' => 0.2,
                'carboidrato' => 28.1,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Arroz, tipo 1, cru',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 358,
                'proteina' => 7.2,
                'lipideos' => 0.3,
                'carboidrato' => 78.8,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Arroz, tipo 2, cozido',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 130,
                'proteina' => 2.6,
                'lipideos' => 0.4,
                'carboidrato' => 28.2,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Arroz, tipo 2, cru',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 368,
                'proteina' => 7.2,
                'lipideos' => 0.3,
                'carboidrato' => 78.9,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Aveia, flocos, crua',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 394,
                'proteina' => 13.9,
                'lipideos' => 8.5,
                'carboidrato' => 66.6,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Biscoito, doce, maisena',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 443,
                'proteina' => 8.1,
                'lipideos' => 12.0,
                'carboidrato' => 75.2,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Biscoito, doce, recheado com chocolate',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 472,
                'proteina' => 6.4,
                'lipideos' => 19.6,
                'carboidrato' => 70.5,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Biscoito, doce, recheado com morango',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 471,
                'proteina' => 5.7,
                'lipideos' => 19.6,
                'carboidrato' => 71.0,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Biscoito, doce, wafer, recheado de chocolate',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 502,
                'proteina' => 5.6,
                'lipideos' => 24.7,
                'carboidrato' => 67.5,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Biscoito, doce, wafer, recheado de morango',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 513,
                'proteina' => 4.5,
                'lipideos' => 26.4,
                'carboidrato' => 67.4,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Biscoito, salgado, cream cracker',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 432,
                'proteina' => 10.1,
                'lipideos' => 14.4,
                'carboidrato' => 68.7,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Biscoito, salgado, cream cracker',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 432,
                'proteina' => 10.1,
                'lipideos' => 14.4,
                'carboidrato' => 68.7,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Bolo, mistura para',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 419,
                'proteina' => 6.2,
                'lipideos' => 6.1,
                'carboidrato' => 84.7,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Bolo, pronto, aipim',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 324,
                'proteina' => 4.4,
                'lipideos' => 12.7,
                'carboidrato' => 47.9,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Bolo, pronto, chocolate',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 410,
                'proteina' => 6.2,
                'lipideos' => 18.5,
                'carboidrato' => 54.7,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Bolo, pronto, coco',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 333,
                'proteina' => 5.7,
                'lipideos' => 11.3,
                'carboidrato' => 52.3,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Bolo, pronto, milho',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 311,
                'proteina' => 4.8,
                'lipideos' => 12.4,
                'carboidrato' => 45.1,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Canjica, branca, crua',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 358,
                'proteina' => 7.2,
                'lipideos' => 1.0,
                'carboidrato' => 78.1,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Canjica, com leite integral',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 112,
                'proteina' => 2.4,
                'lipideos' => 1.2,
                'carboidrato' => 23.6,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Cereais, milho, flocos, com sal',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 370,
                'proteina' => 7.3,
                'lipideos' => 1.6,
                'carboidrato' => 80.8,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Cereais, milho, flocos, sem sal',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 363,
                'proteina' => 6.9,
                'lipideos' => 1.2,
                'carboidrato' => 80.4,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Cereais, mingau, milho, infantil',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 394,
                'proteina' => 6.4,
                'lipideos' => 1.1,
                'carboidrato' => 87.3,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Cereais, mistura para vitamina, trigo, cevada e aveia',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 381,
                'proteina' => 8.9,
                'lipideos' => 2.1,
                'carboidrato' => 81.6,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Cereal matinal, milho',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 365,
                'proteina' => 7.2,
                'lipideos' => 1.0,
                'carboidrato' => 83.8,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Cereal matinal, milho, açúcar',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 377,
                'proteina' => 4.7,
                'lipideos' => 0.7,
                'carboidrato' => 88.8,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Creme de arroz, pó',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 386,
                'proteina' => 7.0,
                'lipideos' => 1.2,
                'carboidrato' => 83.9,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Creme de milho, pó',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 333,
                'proteina' => 4.8,
                'lipideos' => 1.6,
                'carboidrato' => 86.1,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Curau, milho verde',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 78,
                'proteina' => 2.4,
                'lipideos' => 1.6,
                'carboidrato' => 13.9,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Curau, milho verde, mistura para',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 402,
                'proteina' => 2.2,
                'lipideos' => 13.4,
                'carboidrato' => 79.8,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Farinha, de arroz, enriquecida',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 363,
                'proteina' => 1.3,
                'lipideos' => 0.3,
                'carboidrato' => 85.5,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Farinha, de centeio, integral',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 336,
                'proteina' => 12.5,
                'lipideos' => 1.8,
                'carboidrato' => 73.3,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Farinha, de milho, amarela',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 351,
                'proteina' => 7.2,
                'lipideos' => 1.5,
                'carboidrato' => 79.1,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Farinha, de rosca',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 371,
                'proteina' => 11.4,
                'lipideos' => 1.5,
                'carboidrato' => 75.8,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Farinha, de trigo',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 360,
                'proteina' => 9.4,
                'lipideos' => 1.4,
                'carboidrato' => 75.1,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Farinha, láctea, de cereais',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 415,
                'proteina' => 11.9,
                'lipideos' => 5.8,
                'carboidrato' => 77.8,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Lasanha, massa fresca, cozida',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 164,
                'proteina' => 5.8,
                'lipideos' => 1.2,
                'carboidrato' => 32.5,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Lasanha, massa fresca, crua',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 220,
                'proteina' => 7.0,
                'lipideos' => 1.3,
                'carboidrato' => 45.1,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Macarrão, instantâneo',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 436,
                'proteina' => 8.8,
                'lipideos' => 17.2,
                'carboidrato' => 62.4,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Macarrão, trigo, cru',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 371,
                'proteina' => 10.0,
                'lipideos' => 1.3,
                'carboidrato' => 77.9,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Macarrão, trigo, cru, com ovos',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 371,
                'proteina' => 10.3,
                'lipideos' => 2.0,
                'carboidrato' => 76.6,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Milho, amido, cru',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 361,
                'proteina' => 0.6,
                'lipideos' =>  0,
                'carboidrato' => 87.1,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Milho, fubá, cru',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 353,
                'proteina' => 7.2,
                'lipideos' =>  1.9,
                'carboidrato' => 78.9,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Milho, verde, cru',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 138,
                'proteina' => 6.6,
                'lipideos' =>  0.6,
                'carboidrato' => 28.6,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Milho, verde, enlatado, drenado',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 98,
                'proteina' => 3.2,
                'lipideos' =>  2.4,
                'carboidrato' => 17.1,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Mingau tradicional, pó',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 373,
                'proteina' => 0.6,
                'lipideos' =>  0.4,
                'carboidrato' => 89.3,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pamonha, barra para cozimento, pré-cozida',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 171,
                'proteina' => 2.6,
                'lipideos' =>  4.8,
                'carboidrato' => 30.7,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pão, aveia, forma',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 343,
                'proteina' => 12.4,
                'lipideos' =>  5.7,
                'carboidrato' => 59.6,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pão, de soja',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 309,
                'proteina' => 11.3,
                'lipideos' =>  3.6,
                'carboidrato' => 56.5,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pão, glúten, forma',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 253,
                'proteina' => 12.0,
                'lipideos' =>  2.7,
                'carboidrato' => 44.1,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pão, milho, forma',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 292,
                'proteina' => 8.3,
                'lipideos' =>  3.1,
                'carboidrato' => 56.4,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pão, trigo, forma, integral',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 253,
                'proteina' => 9.4,
                'lipideos' =>  3.7,
                'carboidrato' => 49.9,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pão, trigo, francês',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 300,
                'proteina' => 8.0,
                'lipideos' =>  3.1,
                'carboidrato' => 58.6,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pão, trigo, sovado',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 311,
                'proteina' => 8.4,
                'lipideos' =>  2.8,
                'carboidrato' => 61.5,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pastel, de carne, cru',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 289,
                'proteina' => 10.7,
                'lipideos' =>  8.8,
                'carboidrato' => 42.0,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pastel, de carne, frito',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 388,
                'proteina' => 10.1,
                'lipideos' =>  20.1,
                'carboidrato' => 43.8,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pastel, de queijo, cru',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 308,
                'proteina' => 9.9,
                'lipideos' =>  9.6,
                'carboidrato' => 45.9,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pastel, de queijo, frito',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 422,
                'proteina' => 8.7,
                'lipideos' =>  22.7,
                'carboidrato' => 48.1,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pastel, massa, crua',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 310,
                'proteina' => 6.9,
                'lipideos' =>  5.5,
                'carboidrato' => 57.4,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pastel, massa, frita',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 570,
                'proteina' => 6.0,
                'lipideos' =>  40.9,
                'carboidrato' => 49.3,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Pipoca, com óleo de soja, sem sal',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 448,
                'proteina' => 9.9,
                'lipideos' =>  15.9,
                'carboidrato' => 70.3,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Polenta, pré-cozida',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 103,
                'proteina' => 2.3,
                'lipideos' =>  0.3,
                'carboidrato' => 23.3,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Torrada, pão francês',
                'grupo' => 'Cereais e derivados',
                'fonte' => 'TACO',
                'energiaKcal' => 377,
                'proteina' => 10.5,
                'lipideos' =>  3.3,
                'carboidrato' => 74.6,

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],


















        ]);
    }

}
