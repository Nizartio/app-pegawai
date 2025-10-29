<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Inilah kolom-kolom yang aman untuk diisi melalui Employee::create($request->all()).
     * Penting untuk mencegah MassAssignmentException.
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'departemen_id',
        'jabatan_id',
    ];

    /**
     * The attributes that should be cast to native types.
     * Mengubah kolom tanggal menjadi objek Carbon untuk manipulasi tanggal yang mudah.
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
    ];
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    /**
     * Satu pegawai dimiliki oleh satu Jabatan (Position).
     */
    public function position(): BelongsTo
    {
        // Asumsi model Anda untuk Jabatan bernama 'Position'
        return $this->belongsTo(Position::class, 'jabatan_id');
    }
}
