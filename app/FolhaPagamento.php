<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolhaPagamento extends Model
{
    protected $fillable = ['usuarios_id','extensao','periodo'];
}
