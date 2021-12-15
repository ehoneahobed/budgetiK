<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory;

    use SoftDeletes; 

    protected $fillable = [
        'currency_name',
        'currency_code',
        'currency_symbol',
        'currency_status',
        'deleted_at'
    ];
}
