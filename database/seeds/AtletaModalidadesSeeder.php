<?php

use Illuminate\Database\Seeder;

class AtletaModalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { //Futebol masculino
        DB::table('atleta_modalidades')->insert(['atleta_id'=>1,'modalidade_id'=>1]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>2,'modalidade_id'=>1]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>3,'modalidade_id'=>1]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>5,'modalidade_id'=>1]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>6,'modalidade_id'=>1]);

        DB::table('atleta_modalidades')->insert(['atleta_id'=>9,'modalidade_id'=>1]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>8,'modalidade_id'=>1]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>4,'modalidade_id'=>1]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>12,'modalidade_id'=>1]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>11,'modalidade_id'=>1]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>7,'modalidade_id'=>1]);

        //handball feminino
        DB::table('atleta_modalidades')->insert(['atleta_id'=>1,'modalidade_id'=>4]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>2,'modalidade_id'=>4]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>3,'modalidade_id'=>4]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>5,'modalidade_id'=>4]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>6,'modalidade_id'=>4]);

        DB::table('atleta_modalidades')->insert(['atleta_id'=>9,'modalidade_id'=>4]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>8,'modalidade_id'=>4]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>4,'modalidade_id'=>4]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>12,'modalidade_id'=>4]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>11,'modalidade_id'=>4]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>7,'modalidade_id'=>4]);


        DB::table('atleta_modalidades')->insert(['atleta_id'=>2,'modalidade_id'=>2]);
        DB::table('atleta_modalidades')->insert(['atleta_id'=>1,'modalidade_id'=>3]);

        DB::table('atleta_modalidades')->insert(['atleta_id'=>3,'modalidade_id'=>5]);
    }
}