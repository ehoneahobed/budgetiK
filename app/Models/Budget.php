<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\limitToCurrentUserScope;

class budget extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'budget_name',
        'start_date',
        'end_date',
        'deleted_at'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new limitToCurrentUserScope);
    }
}
