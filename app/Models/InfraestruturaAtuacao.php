<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfraestruturaAtuacao extends Model
{
    protected $table = "infraestrutura_atuacao";

    protected $fillable = ['infraestrutura_id','codigo_entidade','codigo_atuacao','nome_atuacao'];

    public function infraestrutura()
    {
        return $this->belongsTo(Infraestrutura::class,'id','infraestrutura_id');
    }
}
