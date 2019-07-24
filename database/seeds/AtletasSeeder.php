<?php

use Illuminate\Database\Seeder;

class AtletasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('atletas')->insert(['pessoa_id'=>1,'tamanho_id'=>2,'descricao'=>'Compromissado', 'altura'=>1.80, 'peso'=> 70.98]);

        DB::table('atletas')->insert(['pessoa_id'=>2,'tamanho_id'=>1,'descricao'=>'Compromissado, esteve em todos os treinos', 'altura'=>1.76, 'peso'=> 95.98]);

        DB::table('atletas')->insert(['pessoa_id'=>3,'tamanho_id'=>3,'descricao'=>'Atleta compromissado, esteve em todos os treinos', 'altura'=>1.60, 'peso'=> 75.98]);

        DB::table('atletas')->insert(['pessoa_id'=>5, 'tamanho_id'=>4,'descricao'=>'Atleta causou tumulto em diversas competicoes e treinos', 'altura'=>1.93, 'peso'=> 75.90]);

        DB::table('atletas')->insert(['pessoa_id'=>6, 'tamanho_id'=>4,'descricao'=>'Atleta Descompromissado', 'altura'=>1.66, 'peso'=> 55.90]);

        DB::table('atletas')->insert(['pessoa_id'=>9,'tamanho_id'=>5,'descricao'=>'Atleta totalmente compromissado com as atividades do grupo', 'altura'=>1.51, 'peso'=> 80.90]);

        DB::table('atletas')->insert(['pessoa_id'=>8, 'tamanho_id'=>5,'descricao'=>'Atleta compromissado, esteve em todos os treinos', 'altura'=>1.65, 'peso'=> 32.90]);

        DB::table('atletas')->insert(['pessoa_id'=>13,'tamanho_id'=>6,'descricao'=>'Atleta compromissado, esteve em todos os treinos', 'altura'=>1.78, 'peso'=> 66.90]);

        DB::table('atletas')->insert(['pessoa_id'=>15, 'tamanho_id'=>7,'descricao'=>'Falta de Compromisso', 'altura'=>1.96, 'peso'=> 95.90]);

        DB::table('atletas')->insert(['pessoa_id'=>11,'tamanho_id'=>3,'descricao'=>'Atleta brigou com companheiros de equipe durante os treinos', 'altura'=>1.58, 'peso'=> 87.90]);

        DB::table('atletas')->insert(['pessoa_id'=>12,'tamanho_id'=>6,'descricao'=>'Atleta faltou a treinos, descompromissado', 'altura'=>1.55, 'peso'=> 63.90]);

        DB::table('atletas')->insert(['pessoa_id'=>7,'tamanho_id'=>1,'descricao'=>'Atleta com atitudes agressivas', 'altura'=>1.66, 'peso'=> 70]);

    }
}
