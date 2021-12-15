<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\limitToCurrentUserScope;

class Texpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'expense_desc',
        'amount',
        'date',
        'deleted_at'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new limitToCurrentUserScope);
    }
}
