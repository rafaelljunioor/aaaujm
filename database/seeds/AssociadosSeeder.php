<?php

use Illuminate\Database\Seeder;

class AssociadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('associados')->insert(['pessoa_id'=>'1', 'data_inicio'=>'2018-01-01 00:00:00', 'data_termino'=>'2019-01-01 00:00:00']);
        DB::table('associados')->insert(['pessoa_id'=>'2', 'data_inicio'=>'2019-01-01 00:00:00', 'data_termino'=>'2020-01-01 00:00:00']);
        DB::table('associados')->insert(['pessoa_id'=>'3', 'data_inicio'=>'2018-01-01 00:00:00', 'data_termino'=>'2019-01-01 00:00:00']);
        DB::table('associados')->insert(['pessoa_id'=>'4', 'data_inicio'=>'2017-01-01 00:00:00', 'data_termino'=>'2018-01-01 00:00:00']);
        DB::table('associados')->insert(['pessoa_id'=>'7', 'data_inicio'=>'2016-01-01 00:00:00', 'data_termino'=>'2017-01-01 00:00:00']);
        DB::table('associados')->insert(['pessoa_id'=>'8', 'data_inicio'=>'2015-01-01 00:00:00', 'data_termino'=>'2016-01-01 00:00:00']);
    }
}
