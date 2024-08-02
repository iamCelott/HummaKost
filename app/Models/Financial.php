<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'types',
        'nominal',
        'payment_proof',
        'status',
        'financial_date',
    ];
}