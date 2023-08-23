<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceList extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'price_lists';

    protected $fillable = [
        'name',
        'price',
    ];
}
