<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Post;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Users posts.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post()
    {
        return $this->hasMany(Post::class, 'author');
    }

    /**
     * Resets Users avatar field to the default value
     *
     */
    public function resetAvatar()
    {
        return $this->update(['avatar' => 'assets/user-avatar.jpg']);
    }

    /**
     * Query the database for all the ubpublished posts
     *
     * @param $query
     */
    public static function getAvatar()
    {
        return self::whereId('1')->pluck('avatar')->toArray();
    }
}
