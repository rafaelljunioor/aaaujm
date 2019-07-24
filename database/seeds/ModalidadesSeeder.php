<?php

use Illuminate\Database\Seeder;

class ModalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modalidades')->insert(['nome'=>'Futebol Masculino','genero'=>'M']);
        DB::table('modalidades')->insert(['nome'=>'Futebol Feminino','genero'=>'F']);
        DB::table('modalidades')->insert(['nome'=>'Handball Masculino','genero'=>'M']);
        DB::table('modalidades')->insert(['nome'=>'Handball Feminino','genero'=>'F']);
        DB::table('modalidades')->insert(['nome'=>'Tenis Masculino','genero'=>'M']);
        DB::table('modalidades')->insert(['nome'=>'Futsal Feminino','genero'=>'M']);
        DB::table('modalidades')->insert(['nome'=>'Futsal Masculino','genero'=>'F']);
        /*DB::table('modalidades')->insert(['nome'=>'Xadrez Masculino','ativo'=>0,'genero'=>'F']);
        DB::table('modalidades')->insert(['nome'=>'Xadrez Feminino','ativo'=>0,'genero'=>'M']);
        DB::table('modalidades')->insert(['nome'=>'Flag Masculino','ativo'=>0,'genero'=>'M']);
        DB::table('modalidades')->insert(['nome'=>'Flag Feminino','ativo'=>0,'genero'=>'F']);
        DB::table('modalidades')->insert(['nome'=>'Volei Masculino','ativo'=>0,'genero'=>'M']);
        DB::table('modalidades')->insert(['nome'=>'Volei Feminino','ativo'=>0,'genero'=>'F']);
        DB::table('modalidades')->insert(['nome'=>'Basquete Masculino','ativo'=>0,'genero'=>'M']);
        DB::table('modalidades')->insert(['nome'=>'Basquete Feminino','ativo'=>0,'genero'=>'F']);
        DB::table('modalidades')->insert(['nome'=>'Atletismo Masculino','ativo'=>0,'genero'=>'M']);
        DB::table('modalidades')->insert(['nome'=>'Atletismo Feminino','ativo'=>0,'genero'=>'F']);
        DB::table('modalidades')->insert(['nome'=>'Peteca Masculino','ativo'=>0,'genero'=>'M']);
        DB::table('modalidades')->insert(['nome'=>'Peteca Feminino','ativo'=>0,'genero'=>'F']);*/
    }
}