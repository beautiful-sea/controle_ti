<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licenca extends Model
{
    protected $fillable = ['chave','produto_id','equipamento_id'];
}
