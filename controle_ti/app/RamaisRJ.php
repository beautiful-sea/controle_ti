<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RamaisRJ extends Model
{
    protected $table = 'ramais_rj';

    protected $fillable = ['ramal','setor_id'];
}
