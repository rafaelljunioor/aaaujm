<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    protected $fillable = ['email', 'nome', 'matricula', 'curso_id', 'telefone'];
    protected $table = 'pessoas';
    //use SoftDeletes;
    //protected $dates = ['deleted_at'];

    public function atleta(){
    	return $this->hasOne('App\Atleta');
    }

    public function associado(){
    	return $this->hasOne('App\Associado');
    }

    public function curso(){
    	return $this->belongsTo('App\Curso');
    }
}
