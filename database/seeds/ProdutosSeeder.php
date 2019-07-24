<?php

use Illuminate\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert(['fornecedor_id'=>'1', 'nome'=>'Camisa Engenhariadas 2018','estoque'=>30,'tamanho_id'=>1, 'preco_sugerido'=>45.00]);

         DB::table('produtos')->insert(['fornecedor_id'=>'2', 'nome'=>'Caneca Engenhariadas 2018','estoque'=>80,'tamanho_id'=>2, 'preco_sugerido'=>25.00]);

         DB::table('produtos')->insert(['fornecedor_id'=>'1', 'nome'=>'Camisa Interatletica 2018','estoque'=>30,'tamanho_id'=>1, 'preco_sugerido'=>50.00]);

         DB::table('produtos')->insert(['fornecedor_id'=>'2', 'nome'=>'Camisa Jumpira','estoque'=>80,'tamanho_id'=>2, 'preco_sugerido'=>48.00]);

         DB::table('produtos')->insert(['fornecedor_id'=>'2', 'nome'=>'KIT OURO','estoque'=>80, 'preco_sugerido'=>80]);

         DB::table('produtos')->insert(['fornecedor_id'=>'2', 'nome'=>'KIT BRONZE','estoque'=>80, 'preco_sugerido'=>80]);

         DB::table('produtos')->insert(['fornecedor_id'=>'2', 'nome'=>'KIT PRATA','estoque'=>80, 'preco_sugerido'=>80]);


    }
}
