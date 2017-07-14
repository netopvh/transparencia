<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infraestrutura extends Model
{

    protected $table = "infraestruturas";

    protected $primaryKey = 'id';

    protected $fillable = ['id','unidade', 'endereco', 'bairro', 'cidade','cep','telefone','codigo_categoria','nome_categoria','codigo_entidade','codigo_atuacao','nome_atuacao'];

    public function atuacoes()
    {
       return $this->hasMany(InfraestruturaAtuacao::class,'infraestrutura_id','id');
    }
}
