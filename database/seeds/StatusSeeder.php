<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([ 'nome'=>'APROVADO']);
        DB::table('status')->insert([ 'nome'=>'PENDENTE']);
        DB::table('status')->insert([ 'nome'=>'CANCELADO']);
    }
}
