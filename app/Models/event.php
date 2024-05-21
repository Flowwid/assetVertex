<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';

    protected $fillable = [
        'name',
        'year',
        'implementation',
        'nominal',
    ];

    public function fund() {
        return $this->hasMany(Fund::class);
    }
}
