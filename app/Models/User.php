<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'house_pictures',
        'blocked',
    ];

    public function pets(): BelongsToMany
    {
        return $this->belongsToMany(Pet::class, 'user_pet');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function hasReviewed($userId)
    {
        return Review::where('reviewer_id', $this->id)
            ->where('user_id', $userId)
            ->exists();
    }

    public function isBlocked()
    {
        return $this->blocked;
    }
}
