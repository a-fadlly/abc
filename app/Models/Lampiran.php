<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lampiran_nu',
        'status',
        'periode',
        'doctor_nu',
        'outlet_nu',
        'product_nu',
        'sales',
        'is_expired',
        'created_by'
    ];
}
