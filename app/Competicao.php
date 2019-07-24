<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competicao extends Model
{
   protected $fillable = ['ativo', 'local','data_inicio', 'data_termino', 'nome'];
   protected $table = 'competicoes';

   public function atletas(){
   		return $this->belongsToMany('App\Atleta','atleta_competicoes','competicao_id', 'atleta_id');
   }

}
