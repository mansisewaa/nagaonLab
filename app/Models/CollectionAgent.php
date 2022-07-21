<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CollectionAgent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'collection_agents';

    protected $fillable = [
        'center_id',
        'agentname',
        'mobile',
        'address',
        'created_by',

    ];
}
