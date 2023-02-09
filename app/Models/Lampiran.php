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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_nu', 'doctor_nu');
    }

    public function outletNu()
    {
        return $this->belongsTo(Outlet::class, 'outlet_nu', 'outlet_nu');
    }

    public function productNu()
    {
        return $this->belongsTo(Product::class, 'product_nu', 'product_nu');
    }

    public function cratedBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
