<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AjuanTabungan extends Model
{
    protected $table = 'ajuan_tabungan';

    protected $fillable = [
        'user_id',
        'jenis',
        'jumlah',
        'status',
        'approved_by', // ✅ tambahkan ini agar nilai bisa disimpan
    ];

    // Relasi ke user yang mengajukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke user yang menyetujui (guru)
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
