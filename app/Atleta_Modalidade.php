<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atleta_Modalidade extends Model
{
    protected $fillable = ['modalidade_id', 'atleta_id'];
    protected $table = 'atleta_modalidades';
    
     /*public function modalidades(){
    	return $this->hasMany('App\Modalidade');
    }

    public function atletas(){
    	return $this->hasMany('App\Atleta');
    }*/
    
}
