<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RamaisValenca extends Model
{
    protected $table = 'ramais_valenca';

    protected $fillable = ['ramal','setor_id','usuarios_id'];

    protected $with = ['colaborador'];

    public function colaborador(){
    	return $this->hasOne('App\User','id','usuarios_id');
    }
}
