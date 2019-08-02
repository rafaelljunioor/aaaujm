<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtletas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atletas', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('pessoa_id')->unsigned()->unique();
            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete('cascade');
            
            $table->integer('tamanho_id')->unsigned();
            $table->foreign('tamanho_id')->references('id')->on('tamanhos')->onDelete('cascade');

            $table->longText('descricao')->nullable();
            $table->decimal('altura', 8, 2)->nullable();
            $table->decimal('peso', 8, 2)->nullable();
            //$table->timestamps();
            
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atletas');
    }
}
