<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GeneralLog extends Model
{
    protected $fillable = [
        'user_id', 'action', 'entity_id', 'model', 'data',
    ];
}
