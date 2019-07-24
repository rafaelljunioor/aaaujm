<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tamanho extends Model
{
    protected $fillable = ['nome'];
    protected $table = 'tamanhos';

    public function atletas(){
    	return $this->hasMany('App\Atleta');
    }

    public function produtos(){
    	return $this->hasMany('App\Produto');
    }
}
