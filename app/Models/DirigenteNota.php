<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirigenteNota extends Model
{
    protected $table = "dirigentes_notas";

    protected $fillable = ['casa_id','notas'];
}
