<?php

use Illuminate\Database\Seeder;

class TamanhosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tamanhos')->insert([ 'nome'=>'P']);
        DB::table('tamanhos')->insert([ 'nome'=>'M']);
        DB::table('tamanhos')->insert([ 'nome'=>'G']);
        DB::table('tamanhos')->insert([ 'nome'=>'GG']);
        DB::table('tamanhos')->insert([ 'nome'=>'PBL']);
        DB::table('tamanhos')->insert([ 'nome'=>'MBL']);
        DB::table('tamanhos')->insert([ 'nome'=>'GBL']);
        DB::table('tamanhos')->insert([ 'nome'=>'EGBL']);
        DB::table('tamanhos')->insert([ 'nome'=>'Único']);
    }
}
