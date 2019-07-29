<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Armario extends Model
{
    protected $fillable = ['numero','usuarios_id','local'];

    const LOCAL_INTERNO = 0;
    const LOCAL_EXTERNO_MASCULINO = 1;

    public function usuario(){
    	return $this->belongsTo('App\User','usuarios_id','id');
    }

    public static function local() {
        return [
            self::LOCAL_INTERNO => 'Armário Interno',
            self::LOCAL_EXTERNO_MASCULINO => 'Armário Externo Masculino',
        ];
    }

    public function getLocalStringAttribute() {
        return self::local()[$this->local];
    }
}
