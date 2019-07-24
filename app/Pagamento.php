<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    public function venda(){
    	return $this->belongsTo('App\Venda');
    }

}
