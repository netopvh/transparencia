<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorpoTecnico extends Model
{
    /**
     * Trait que gerencia exclusões do banco de dados
     *
     * @trait SoftDeletes
     */
    use SoftDeletes;

    /**
     * Referencia tabela do banco de dados
     *
     * @var string
     */
    protected $table = "corpo_tecnico";

    /**
     * Campos Permitidos para inserção de Dados
     *
     * @var array
     */
    protected $fillable = ['casa_id','nome'];

    /**
     * Relacionamento One to One
     * @param Table Casa
     * @param Table CorpoTecnico
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function casa()
    {
        return $this->belongsTo(Casa::class);
    }
}
