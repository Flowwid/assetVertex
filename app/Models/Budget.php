<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'budget';

    protected $fillable = [
        'name',
        'year',
        'nominal',
    ];

    public function fund() {
        return $this->hasMany(Fund::class);
    }
}
