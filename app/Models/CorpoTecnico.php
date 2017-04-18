<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorpoTecnico extends Model
{
    protected $table = "corpo_tecnico";

    protected $fillable = ['casa_id','nome'];
}
