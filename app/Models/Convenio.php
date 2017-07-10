<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $dates = ['data'];

    protected $fillable = ['casa_id','numero','data','objeto','tipo','razao','cnpj','valor'];

    public function casa()
    {
        return $this->belongsTo(Casa::class);
    }

    public function getDataAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setDataAttribute($value)
    {
        if (strlen($value) > 0){
            try{
                return $this->attributes['data'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['data'] = date('Y-m-d');
            }
        }
    }

    public function getValorAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
}
