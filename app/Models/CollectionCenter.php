<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CollectionCenter extends Model
{
    use HasFactory;
    use SoftDeletes;


     protected $table = 'coll-center';
     protected $fillable = [
        'code', 'name','address','city','state','zip','mobile','email',
    ];
}
