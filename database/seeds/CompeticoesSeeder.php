<?php

use Illuminate\Database\Seeder;

class CompeticoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('competicoes')->insert(['nome'=>'Engenhariadas','local'=>'Governador Valadares', 'data_inicio'=>'2018-01-01 00:00:00', 'data_termino'=>'2019-01-01 00:00:00']);
      
      DB::table('competicoes')->insert(['nome'=>'CAV','local'=>'Ipatinga', 'data_inicio'=>'2018-01-01 00:00:00', 'data_termino'=>'2019-01-01 00:00:00']);

      DB::table('competicoes')->insert(['nome'=>'Engenhariadas Mineiro 2019','local'=>'Sete Lagoas', 'data_inicio'=>'2018-01-01 00:00:00', 'data_termino'=>'2019-01-01 00:00:00']);

      DB::table('competicoes')->insert(['nome'=>'Engenhariadas Mineiro 2018','local'=>'João Monlevade', 'data_inicio'=>'2018-01-01 00:00:00', 'data_termino'=>'2019-01-01 00:00:00']);

      DB::table('competicoes')->insert(['nome'=>'CAV 2017','local'=>'Governador Valadares', 'data_inicio'=>'2018-01-01 00:00:00', 'data_termino'=>'2019-01-01 00:00:00']);

      DB::table('competicoes')->insert(['nome'=>'InterAtleticas','local'=>'Ouro Preto', 'data_inicio'=>'2018-01-01 00:00:00', 'data_termino'=>'2019-01-01 00:00:00']);

    }
}