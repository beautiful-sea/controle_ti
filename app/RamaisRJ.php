<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RamaisRJ extends Model
{
    protected $table = 'ramais_rj';

    protected $fillable = ['ramal','setor_id','usuarios_id'];

    protected $with = ['colaborador'];



    public function colaborador(){
    	return $this->hasOne('App\User','id','usuarios_id');
    }
}
