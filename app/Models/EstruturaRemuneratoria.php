<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstruturaRemuneratoria extends Model
{

    protected $table = "estrutura_remuneratoria";

    protected $fillable = ['casa_id','cargo','ponto_ini','ponto_fin','empregados'];

}
