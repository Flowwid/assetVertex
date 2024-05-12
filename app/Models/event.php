<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\division;
class event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'end_date',
        'division_id',
        'division_name',
    ];
}

