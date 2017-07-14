<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirigenteFile extends Model
{
    protected $table = "dirigentes_files";

    protected $fillable = ['casa_id','type','file'];
}
