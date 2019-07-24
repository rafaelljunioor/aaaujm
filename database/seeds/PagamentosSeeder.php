<?php

use Illuminate\Database\Seeder;

class PagamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pagamentos')->insert(['nome'=>'Cartão de Credito']);
        DB::table('pagamentos')->insert(['nome'=>'Cartão de Débito']);
        DB::table('pagamentos')->insert(['nome'=>'Dinheiro']);
    }
}
