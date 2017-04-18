<?php

namespace App\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['casa_id','description','script','bloco','link'];

    public function casa()
    {
        return $this->belongsTo('App\Models\Casa','casa_id');
    }

}