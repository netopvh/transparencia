<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{

    protected $fillable = ['casa_id','type','year','file'];

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
