<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AjuanTabungan extends Model
{
    protected $table = 'ajuan_tabungan'; // penting!
    
    protected $fillable = ['user_id', 'jenis', 'jumlah', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

