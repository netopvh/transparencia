<?php

namespace App\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Menu extends Model implements Transformable
{
    use TransformableTrait, Sluggable;

    protected $fillable = ['casa_id','title','slug','type','path','sidebar','ldo','submenu','linked'];

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
        return $this->belongsTo('App\Models\Casa','casa_id');
    }

    public function getTitleAttribute($value)
    {
        return $this->ucword_new(strtolower($value));
    }

    /**
     * @param $value
     * @return string
     */
    public function ucword_new($value)
    {
        $excludes = ['de','da','do','das','dos'];
        $data = explode(' ',$value);
        $result = [];
        foreach ($data as $item) {
            if (in_array($item, $excludes)){
                $result[] = $item;
            }else{
                $result[] = ucwords($item);
            }
        }
        return implode(' ',$result);
    }
}