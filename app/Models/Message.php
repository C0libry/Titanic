<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';

    protected $fillable = [
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'bool',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_user_id', 'id');
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
