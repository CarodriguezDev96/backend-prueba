<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Database;

class ErrorLog extends Model
{
    use Database;

    protected $fillable = [
        'type',
        'error'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function saveOrUpdate(array $data)
    {
        $this->persist(ErrorLog::class, $data);
    }
}
