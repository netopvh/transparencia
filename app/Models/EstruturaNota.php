<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstruturaNota extends Model
{

    protected $table = 'estrutura_remuneratoria_notas';

    protected $fillable = ['casa_id','notas'];

}
