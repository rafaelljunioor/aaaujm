<?php

use Illuminate\Database\Seeder;

class PessoasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pessoas')->insert(['nome'=>'Marcelo Nobrega Rodrigues', 'matricula'=>'14.2.8570','email'=>'juniorrafael@yahoo.com.br','telefone'=>'(31) 9 9442 1796','curso_id'=>2]);

        DB::table('pessoas')->insert(['nome'=>'Gabriel Junior Martins', 'matricula'=>'14.2.8571','email'=>'Gabriel@yahoo.com.br','telefone'=>'(31) 9 9442 1799','curso_id'=>1]);


        DB::table('pessoas')->insert(['nome'=>'Lorraine ', 'matricula'=>'14.2.8572','email'=>'Lorraine@yahoo.com.br','telefone'=>'(31) 9 9442 5252','curso_id'=>2]);

        DB::table('pessoas')->insert(['nome'=>'Rosiane Aparecida Cota', 'matricula'=>'14.2.8573','email'=>'rose@yahoo.com.br','telefone'=>'(31) 9 9442 6650','curso_id'=>3]);

        DB::table('pessoas')->insert(['nome'=>'Jose Da Conceicao Avelino', 'matricula'=>'14.2.8574','email'=>'jose@yahoo.com.br','telefone'=>'(31) 9 8785 1796','curso_id'=>3]);

        DB::table('pessoas')->insert(['nome'=>'Silane Avelino', 'matricula'=>'14.0.0000','email'=>'silane@yahoo.com.br','telefone'=>'(31) 9 5251 3300','curso_id'=>1]);

        DB::table('pessoas')->insert(['nome'=>'Alessandro Rodrigues', 'matricula'=>'14.1.1111','email'=>'sandrin@yahoo.com.br','telefone'=>'(31) 9 6666 9652','curso_id'=>2]);

        DB::table('pessoas')->insert(['nome'=>'Joao Pedro', 'matricula'=>'14.2.2222','email'=>'joaopedro@yahoo.com.br','telefone'=>'(52) 9 6232 1796','curso_id'=>4]);

        DB::table('pessoas')->insert(['nome'=>'Gilda Assis', 'matricula'=>'14.2.2223','email'=>'gilda@yahoo.com.br','telefone'=>'(31) 9 3200 0220','curso_id'=>2]);

        DB::table('pessoas')->insert(['nome'=>'Elias Maximo', 'matricula'=>'14.2.2224','email'=>'elias@yahoo.com.br','telefone'=>'(31) 0 5122 1796','curso_id'=>1]);

        DB::table('pessoas')->insert(['nome'=>'Sandro Meira Ricci', 'matricula'=>'14.2.2225','email'=>'sandro@yahoo.com.br','telefone'=>'(31) 9 9966 5523','curso_id'=>3]);

        DB::table('pessoas')->insert(['nome'=>'Hebert Carvalho', 'matricula'=>'14.2.2226','email'=>'hebert@yahoo.com.br','telefone'=>'(31) 9 6362 6623','curso_id'=>4]);

        DB::table('pessoas')->insert(['nome'=>'Maximiliano Carvalho', 'matricula'=>'14.2.2227','email'=>'maximiliano@yahoo.com.br','telefone'=>'(31) 9 5202 6630','curso_id'=>2]);

        DB::table('pessoas')->insert(['nome'=>'Beatriz', 'matricula'=>'14.2.2228','email'=>'beatriz@yahoo.com.br','telefone'=>'(31) 9 9442 1796','curso_id'=>4]);

        DB::table('pessoas')->insert(['nome'=>'Marcelo Carvalho', 'matricula'=>'14.2.2229','email'=>'marcelo@yahoo.com.br','telefone'=>'(31) 5 9442 1796','curso_id'=>1]);

        DB::table('pessoas')->insert(['nome'=>'Diego Alvez', 'matricula'=>'14.2.2230','email'=>'diego@yahoo.com.br','telefone'=>'(31) 7 9442 1796','curso_id'=>2]);


        DB::table('pessoas')->insert(['nome'=>'Fabio Marques', 'matricula'=>'14.2.2231','email'=>'fabioo@yahoo.com.br','telefone'=>'(31) 8 9442 1796','curso_id'=>3]);

        DB::table('pessoas')->insert(['nome'=>'Cintia de Nobrega', 'matricula'=>'14.2.2232','email'=>'cintia@yahoo.com.br','telefone'=>'(31) 9 6620 1796','curso_id'=>3]);
    }
}
