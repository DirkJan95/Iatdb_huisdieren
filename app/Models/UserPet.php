<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_pet';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'pet_id',
    ];

    /**
     * Get the user associated with the user pet.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the pet associated with the user pet.
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
