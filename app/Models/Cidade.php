<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;

class Cidade extends Model
{
    protected $fillable = ['name', 'estado_id'];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
