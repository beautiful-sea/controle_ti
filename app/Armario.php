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

    public static function getVazios(){
        $internos_ocupados = Armario::whereRaw('numero BETWEEN 1 AND 28 AND local = 0')->get();
        $externos_masculino_ocupados = Armario::whereRaw('numero BETWEEN 1 AND 42 AND local = 1')->get();

        $internos_vazios = Array();
        $externos_masculino_vazios = Array();

        //Cada indice do array representa o armário + 1: ex: $internos_vazios[0] representa armario número 1
        
        for ($i=0; $i < 28 ; $i++) { //Criar um array com o numero de armarios 
            $internos_vazios[$i] = Array();
        }
        foreach ($internos_ocupados as $key => $value) {//Retira o indice do array que tem o armario ocupado
            unset($internos_vazios[($value->numero - 1)]);
        }

        for ($i=0; $i < 42 ; $i++) { //Criar um array com o numero de armarios 
            $externos_masculino_vazios[$i] = Array();
        }
        foreach ($externos_masculino_ocupados as $key => $value) {//Retira o indice do array que tem o armario ocupado
            unset($externos_masculino_vazios[($value->numero - 1)]);
        }

        $armarios_vazios['externos_masculino'] = $externos_masculino_vazios;
        $armarios_vazios['internos'] = $internos_vazios;

        //Exibir o número do armario considerando + 1. ex: '$armario[1] = armário 2', então se quero o armario 1 devo usar $armario[0] ou $armario[$numero - 1];
        return $armarios_vazios;
    }

    public function getLocalStringAttribute() {
        return self::local()[$this->local];
    }
}
