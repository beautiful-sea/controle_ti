<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    protected $fillable = ['titulo','descricao','data_inicio','data_fim','color','setor_id'];
}
