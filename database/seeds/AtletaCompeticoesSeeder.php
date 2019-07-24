<?php

use Illuminate\Database\Seeder;

class AtletaCompeticoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('atleta_competicoes')->insert(['atleta_id'=>2,'competicao_id'=>1]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>3,'competicao_id'=>1]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>4,'competicao_id'=>1]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>5,'competicao_id'=>1]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>6,'competicao_id'=>1]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>7,'competicao_id'=>1]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>8,'competicao_id'=>1]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>9,'competicao_id'=>1]);

      	 DB::table('atleta_competicoes')->insert(['atleta_id'=>1,'competicao_id'=>2]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>3,'competicao_id'=>2]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>4,'competicao_id'=>2]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>5,'competicao_id'=>2]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>6,'competicao_id'=>2]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>7,'competicao_id'=>2]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>8,'competicao_id'=>2]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>9,'competicao_id'=>2]);

        
         DB::table('atleta_competicoes')->insert(['atleta_id'=>3,'competicao_id'=>3]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>9,'competicao_id'=>3]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>5,'competicao_id'=>3]);
         
         DB::table('atleta_competicoes')->insert(['atleta_id'=>6,'competicao_id'=>4]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>7,'competicao_id'=>4]);
         DB::table('atleta_competicoes')->insert(['atleta_id'=>8,'competicao_id'=>4]);
         
    }
}
