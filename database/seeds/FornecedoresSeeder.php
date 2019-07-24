<?php

use Illuminate\Database\Seeder;

class FornecedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fornecedores')->insert(['nome'=>'START UNIFORMES', 'cnpj'=>'29.611.183/0001-63','email'=>'startuniformes@gmail.com','telefone'=>'(31) 9 9999 9999', 'descricao'=>'Fornecedora de Uniformes dos atletas']);

        DB::table('fornecedores')->insert(['nome'=>'GUEDES ALUMINIO', 'cnpj'=>'29.611.183/0001-64','email'=>'guedesAluminio@gmail.com','telefone'=>'(31) 9 9999 8888', 'descricao'=>'Fornecedor de Canecas e Tirantes']);

         DB::table('fornecedores')->insert(['nome'=>'TIRANTE FORNECEDORA', 'cnpj'=>'29.611.183/0001-68','email'=>'tirantes@gmail.com','telefone'=>'(31) 9 9999 8755', 'descricao'=>'Fornecedor de Tirantes']);

          DB::table('fornecedores')->insert(['nome'=>'GUEDES ALUMINIO', 'cnpj'=>'29.611.183/0001-67','email'=>'caps@gmail.com','telefone'=>'(31) 9 5622 9999', 'descricao'=>'Bones customizados']);
    }
}
