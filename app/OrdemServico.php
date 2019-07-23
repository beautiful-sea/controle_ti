<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    protected $fillable = ['equipamento_id','usuario_id','cadastrante_id','setor_id','descricao','resolucao','status'];

    protected $table = 'ordem_servicos';

    protected $with =['equipamento','cadastrante','setor','usuario'];

    public static function getStatusInText($status){

    	switch ($status) {
    		case 0:
    			return 'Solicitado';
    			break;
    		case 1:
    			return 'Recebido';
    			break;
    		case 2:
    			return 'Em execução';
    			break;
    		case 3:
    			return 'Resolvido';
    			break;
    		case 4:
    			return 'Não resolvido';
    			break;
    		default:
    			return 'Solicitada';
    			break;
    	}
    }

    public static function getStatusFormated($status){

    	switch ($status) {
    		case 0:
    			return '<div class="badge badge-info">Solicitado</div>';
    			break;
    		case 1:
    			return '<div class="badge badge-primary">Recebido</div>';
    			break;
    		case 2:
    			return '<div class="badge badge-warning">Em execução</div>';
    			break;
    		case 3:
    			return '<div class="badge badge-success">Resolvido</div>';
    			break;
    		case 4:
    			return '<div class="badge badge-danger">Não resolvido</div>';
    			break;
    		default:
    			return '<div class="badge badge-success">Solicitada</div>';
    			break;
    	}
    }

    public function cadastrante(){
        return $this->belongsTo('App\User','cadastrante_id','id');
    }

    public function usuario(){
        return $this->belongsTo('App\User','usuario_id','id');
    }

    public function equipamento(){
        return $this->hasOne('App\Equipamento','id','equipamento_id');
    }

    public function setor(){
        return $this->hasOne('App\Setor','id','setor_id');
    }
}
