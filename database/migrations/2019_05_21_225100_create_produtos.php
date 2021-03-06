<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('fornecedor_id')->unsigned();
            $table->string('nome',191);
            $table->integer('estoque')->unsigned();
            $table->decimal('preco_socio',8, 2);
            $table->decimal('preco_nao_socio',8, 2);
            $table->integer('tamanho_id')->nullable();
            $table->softDeletes();
            //$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->nullable();
            $table->engine = 'InnoDB';
            //$table->timestamps();

            
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
