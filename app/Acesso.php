<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    protected $fillable = ['user_id'];

    protected $with = ['user'];


    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
}
