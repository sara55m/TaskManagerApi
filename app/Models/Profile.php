<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    protected $fillable = [
        'phone',
        'address',
        'date_of_birth',
        'bio',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
