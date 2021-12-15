<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'currency_id',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
}
