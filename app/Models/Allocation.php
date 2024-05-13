<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;

    protected $table = 'allocation';

    protected $fillable = [
        'event_id',
        'event_name',
        'division_id',
        'division_name',
    ];
}
