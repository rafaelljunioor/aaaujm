<?php

use Illuminate\Database\Seeder;

class ServicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         DB::table('servicos')->insert(['nome'=>'ASSOCIAÇÃO','preco_sugerido'=>40.00, 'descricao'=>'inclusao de informação 3']);

         DB::table('servicos')->insert(['nome'=>'RENOVAÇÃO','preco_sugerido'=>48.50, 'descricao'=>'inclusao de informação 4']);
    }
}
