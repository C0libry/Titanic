<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function find_by_username($username)
    {
        return DB::table('users')
            ->where('users.username', '=', $username)
            ->select('users.*')
            ->first();
    }

    public function created_chats()
    {
        return $this->hasMany(Chat::class, 'creator_user_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Chat::class, 'sender_user_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Chat::class, 'task_to_user_id', 'id');
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_users', 'user_id', 'chat_id');
    }
}
