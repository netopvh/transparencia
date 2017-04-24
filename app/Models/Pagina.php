<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    use Sluggable;

    protected $fillable = ['casa_id','title','script','slug'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function casa()
    {
        return $this->belongsTo(Casa::class);
    }
}
