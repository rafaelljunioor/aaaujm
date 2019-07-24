<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Pedido extends Model
{ 
    
	 use SoftDeletes;
    protected $dates = ['deleted_at'];

     public function produto(){
    	return $this->belongsTo('App\Produto')->withTrashed();
    }

    public function servico(){
    	return $this->belongsTo('App\Servico');
    }

    public function venda(){
    	return $this->belongsTo('App\Venda');
    }
}
