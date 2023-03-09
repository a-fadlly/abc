<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'outlet_nu',
        'name',
        'address',
        'outlet_nu_uni',
        'name_uni',
        'address_uni',
    ];
}
