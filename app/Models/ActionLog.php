<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'action_type ',
        'target_type',
        'target_id ',
        'user_id',
        'name',
        'note',
    ];
}
