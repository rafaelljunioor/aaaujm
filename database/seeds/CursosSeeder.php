<?php

use Illuminate\Database\Seeder;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cursos')->insert(['nome'=>'SISTEMAS DE INFORMACAO']);
        DB::table('cursos')->insert(['nome'=>'ENGENHARIA ELETRICA']);
        DB::table('cursos')->insert(['nome'=>'ENGENHARIA DA COMPUTACAO']);
        DB::table('cursos')->insert(['nome'=>'ENGENHARIA DE PRODUCAO']);
    }
}
