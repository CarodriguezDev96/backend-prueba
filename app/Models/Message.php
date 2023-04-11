<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use App\Traits\Database;

class Message extends Model
{
    use Database;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'source_user',
        'destination_user',
        'message'
    ];

    public function saveOrUpdate(array $data): ?Message
    {
        return $this->persist(Message::class, $data);
    }
}
