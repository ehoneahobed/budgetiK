<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\limitToCurrentUserScope;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'budget_id',
        'category_id',
        'income_desc',
        'budgeted_amount',
        'deleted_at'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new limitToCurrentUserScope);
    }
}
