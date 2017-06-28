<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contabil extends Model
{

    protected $table = "contabeis";

    protected $fillable = ['type','file','casa_id'];

}
