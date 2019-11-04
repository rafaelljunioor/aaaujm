<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{

   use SoftDeletes;
   protected $dates = ['deleted_at'];

   protected $fillable = ['fornecedor_id','nome', 'estoque', 'tamanho_id', 'ativo', 'preco_socio', 'preco_nao_socio'];
   //protected $table = 'produtos';


   public function fornecedor(){
   		return $this->belongsTo('App\Fornecedor');
   }

   public function tamanho(){
   		return $this->belongsTo('App\Tamanho');
   }

   public function pedidos(){
         return $this->hasMany('App\Pedido');
   }
}
