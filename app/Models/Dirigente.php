<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dirigente extends Model
{
    /**
     * Trait que gerencia exclusões do banco de dados
     *
     * @trait SoftDeletes
     */
    use SoftDeletes;

    /**
     * Campos Permitidos para inserção de Dados
     *
     * @var array
     */
    protected $fillable = ['casa_id','nome'];

    /**
     * Relacionamento One to One
     * @param Table Casa
     * @param Table Dirigente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function casa()
    {
        return $this->belongsTo(Casa::class);
    }
}
