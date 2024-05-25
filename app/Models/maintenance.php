<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenance';

    protected $fillable = [
        'date',
        'description',
        'status',
        'image',
        'asset_id',
        'asset_name',
        'bom_id',
        'bom_serial',
        'division_id',
        'division_name',
    ];
}
