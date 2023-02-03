<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'periode',
        'outlet_id',
        'product_nu',
        'sales',
        'is_expired',
        'created_by'
    ];
}
