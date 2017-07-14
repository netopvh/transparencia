<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorpoTecnicoNota extends Model
{
    protected $table = "corpo_tecnico_notas";

    protected $fillable = ['casa_id','notas'];
}
