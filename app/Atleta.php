<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atleta extends Model
{
    protected $fillable = ['pessoa_id', 'ativo', 'tamanho_id', 'descricao', 'altura', 'peso'];
    protected $table = 'atletas';
    
    public function pessoa(){
    	return $this->belongsTo('App\Pessoa');
    }

    public function tamanho(){
      return $this->belongsTo('App\Tamanho');
    }

    public function competicoes(){
   		return $this->belongsToMany("App\Competicao", "atleta_competicoes", 'atleta_id', 'competicao_id');
   }

   public function modalidades(){
   		return $this->belongsToMany("App\Modalidade", "atleta_modalidades", 'atleta_id', 'modalidade_id');
   }
}