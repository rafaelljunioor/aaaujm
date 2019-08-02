<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('associado_id')->nullable()->unsigned();
            $table->integer('user_id')->unsigned()->default(1);
            $table->integer('pagamento_id')->unsigned();
            $table->integer('status_id')->unsigned()->default(2);
            $table->decimal('valor_total_venda',8, 2)->default(0);
            $table->decimal('valor_total_venda_sem_desconto',8, 2)->default(0);
            $table->integer('desconto')->default(0);
            
            
            //$table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('pagamento_id')->references('id')->on('pagamentos')->onDelete('cascade');
            $table->foreign('associado_id')->references('id')->on('associados')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           

            //$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('vendas');
    }
}
