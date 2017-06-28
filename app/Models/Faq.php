<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['casa_id','question','answer'];

    public function casa()
    {
        return $this->belongsTo(Casa::class);
    }
}
