<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RamaisValenca extends Model
{
    protected $table = 'ramais_valenca';

    protected $fillable = ['ramal','setor_id'];
}
