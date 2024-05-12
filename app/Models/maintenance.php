<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\division;

class maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'condition',
        'description',
        'status',
        'division_id',
        'division_name',
        'asset_bom_id',
        'asset_bom_serial',
        'feedback_note',
    ];

    public function division_id()
    {
        return $this->belongsTo(division_id::class);
    }
}
