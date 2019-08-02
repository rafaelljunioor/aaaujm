<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venda_id')->unsigned();
            $table->integer('produto_id')->nullable()->unsigned();
            $table->integer('servico_id')->nullable()->unsigned();

            $table->decimal('valor_unitario',8,2);
            $table->integer('quantidade')->unsigned();
            $table->decimal('valor_total_item',8,2);
            $table->softDeletes();
            
            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            $table->foreign('servico_id')->references('id')->on('servicos')->onDelete('cascade');

            //$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(\DB::raw('NULL on update CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->nullable();
            $table->engine = 'InnoDB';
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
