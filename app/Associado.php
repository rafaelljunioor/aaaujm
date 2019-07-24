<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Associado extends Model
{

	use SoftDeletes;
    protected $dates = ['deleted_at'];

	protected $table = 'associados';
	
    public function pessoa(){
    	return $this->belongsTo('App\Pessoa');
    }

    public function vendas(){
    	return $this->hasMany('App\Venda');
    }
}
