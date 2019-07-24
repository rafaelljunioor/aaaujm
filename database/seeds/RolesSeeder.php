<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('roles')->insert(['nome'=>'Administrador']);
         DB::table('roles')->insert(['nome'=>'Usuário Loja']);
         DB::table('roles')->insert(['nome'=>'Usuário Esportivo']);
         DB::table('roles')->insert(['nome'=>'Usuário']);
    }
}
