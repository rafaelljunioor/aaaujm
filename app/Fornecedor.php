<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Fornecedor extends Model
{
   use SoftDeletes;
   protected $dates = ['deleted_at'];

   protected $fillable = ['cnpj', 'email', 'telefone', 'descricao', 'nome'];
   protected $table = 'fornecedores';

   public function produtos(){
   		return $this->hasMany('App\Produto');
   }
}
