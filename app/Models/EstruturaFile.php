<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstruturaFile extends Model
{
    protected $table = 'estrutura_remuneratoria_files';

    protected $fillable = ['casa_id','type','file'];
}
