<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
	protected $table = 'cursos';
	protected $fillable = ['nome'];
    public function pessoa(){
    	return $this->hasMany('App\Pessoa');
    }
}
