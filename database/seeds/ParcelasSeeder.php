<?php

use Illuminate\Database\Seeder;

class ParcelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parcelas')->insert(['venda_id'=>1, 'numero'=>1,'status'=>'PAGO','valor_parcela'=>186.00]);
        DB::table('parcelas')->insert(['venda_id'=>1, 'numero'=>2,'status'=>'PAGO', 'valor_parcela'=>186.00]);
        DB::table('parcelas')->insert(['venda_id'=>1, 'numero'=>3,'status'=>'PAGO', 'valor_parcela'=>189.00]);

        DB::table('parcelas')->insert(['venda_id'=>2, 'numero'=>1,'status'=>'PAGO', 'valor_parcela'=>86.00]);
        DB::table('parcelas')->insert(['venda_id'=>2, 'numero'=>2, 'valor_parcela'=>86.00]);
        DB::table('parcelas')->insert(['venda_id'=>2, 'numero'=>3, 'valor_parcela'=>88.00]);


        DB::table('parcelas')->insert(['venda_id'=>3, 'numero'=>1,'status'=>'PAGO', 'valor_parcela'=>80.00]);
        
    }
}
