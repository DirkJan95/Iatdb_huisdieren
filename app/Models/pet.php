<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'breed',
        'date',
        'how_long',
        'cost',
        'age',
        'pet_picture',
    ];

    /**
     * Get the users associated with the pet.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_pet', 'pet_id', 'user_id');
    }
}
