<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dirigente extends Model
{
    protected $fillable = ['casa_id','nome'];

    public function casa()
    {
        return $this->belongsTo(Casa::class);
    }
}
