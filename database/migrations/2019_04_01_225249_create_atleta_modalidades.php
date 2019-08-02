<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateAtletaModalidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atleta_modalidades', function (Blueprint $table) {
        
            $table->integer('atleta_id')->unsigned();
            $table->integer('modalidade_id')->unsigned();
           // $table->longText('descricao')->nullable();
            $table->foreign('atleta_id')->references('id')->on('atletas')->onDelete('cascade');
            $table->foreign('modalidade_id')->references('id')->on('modalidades')->onDelete('cascade');

            $table->primary(['atleta_id','modalidade_id']);
            //$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            
            $table->engine = 'InnoDB';
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atleta_modalidades');
    }
}
