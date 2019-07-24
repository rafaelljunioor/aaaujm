<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
	protected $fillable = ['ativo', 'nome','genero'];
	protected $table = 'modalidades';

    public function atletas(){
   		return $this->belongsToMany('App\Atleta', 'atleta_modalidades', 'modalidade_id', 'atleta_id');
   }
}
