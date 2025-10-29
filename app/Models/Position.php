<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jabatan',
        'gaji_pokok',
    ];

    protected $casts = [
        'gaji_pokok' => 'decimal:2',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'jabatan_id'); 
    }
}