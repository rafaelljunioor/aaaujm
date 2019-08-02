<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([ 'name'=>'Administrador', 'email'=>'admin@hotmail.com', 'password'=>bcrypt('admin123'), 'type'=>1, 'deleted_at'=>NULL]);

         DB::table('users')->insert([ 'name'=>'loja', 'email'=>'loja@hotmail.com', 'password'=>bcrypt('loja123'), 'type'=>1]);

         DB::table('users')->insert([ 'name'=>'esportivo', 'email'=>'esportivo@hotmail.com', 'password'=>bcrypt('loja123'), 'type'=>1]);

         DB::table('users')->insert([ 'name'=>'usuario', 'email'=>'user@hotmail.com', 'password'=>bcrypt('loja123'), 'type'=>1]);

    }
}
