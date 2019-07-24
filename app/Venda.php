<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
	//protected $fillable = ['associado_id', 'pagamento_id', 'user_id', 'produto_id', 'valor', 'desconto', 'quantidade'];
    
    public function associado(){
    	return $this->belongsTo('App\Associado')->withTrashed();
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }


    public function pagamento(){
    	return $this->belongsTo('App\Pagamento');
    }

    public function status(){
        return $this->belongsTo('App\Status');
    }

    public function pedidos(){
        return $this->hasMany('App\Pedido');
    }

    public function parcelas(){
        return $this->hasMany('App\Parcela');
    }


}
