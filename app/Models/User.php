<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'email',
        'password',
        'address',
        'phone',
        'age',
        'gender',
        'languages',
        'surname'
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
        'password' => 'hashed',
    ];

    public function educations(): HasMany
    {
        return $this->hasMany(Educations::class,'user_id','id');
    }
    public function informations(): HasMany
    {
        return $this->hasMany(informations::class,'user_id','id');
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skills::class,'user_id','id');
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class,'user_id','id');
    }
    public function visitors(): HasMany
    {
        return $this->hasMany(Visitors::class,'user_id','id');
    }
    public function images(): HasMany
    {
        return $this->hasMany(images::class,'user_id','id');
    }
}
