<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();

            // Cukup satu baris ini saja untuk foreign key
            $table->foreignId('karyawan_id')->constrained('employees')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->date('tanggal');
            $table->time('waktu_masuk')->nullable();
            $table->time('waktu_keluar')->nullable();
            $table->enum('status_absensi', ['hadir', 'izin', 'sakit', 'alpha']);
            $table->timestamps(); // Ini sudah benar
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};