<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Integridade extends Model
{
    protected $fillable =['casa_id','year','type','file','published'];

    public function casa()
    {
        return $this->belongsTo(Casa::class);
    }
}
