<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    protected $fillable = ['equipamento_id','usuario_id','cadastrante_id','setor_id','descricao','resolucao','status'];


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
}