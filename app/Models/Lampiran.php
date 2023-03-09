<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'lampiran_nu',
        'status',
        'doctor_nu',
        'outlet_nu',
        'product_nu',
        'price_at_that_time',
        'quantity',
        'sales',
        'is_expired',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_nu', 'doctor_nu');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_nu', 'outlet_nu_uni');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_nu', 'product_nu');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'username');
    }
}
