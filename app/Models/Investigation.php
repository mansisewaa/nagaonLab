<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Investigation extends Model
{
    use HasFactory;
    use SoftDeletes;

     protected $table = 'investigation';
     protected $fillable = [
        'core', 'investname','code','price',
    ];
}
