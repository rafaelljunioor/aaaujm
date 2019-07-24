<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atleta_Competicao extends Model
{
    protected $fillable = ['competicao_id', 'atleta_id'];
	protected $table = 'atleta_competicoes';

   
}
