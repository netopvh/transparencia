<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorpoTecnicoFile extends Model
{
    protected $table = 'corpo_tecnico_files';

    protected $fillable = ['casa_id','type','file'];
}
