<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AjuanTabungan;

class AdminController extends Controller
{
    public function riwayat()
{
    // Riwayat semua setoran siswa (jenis = setor, status success)
    $riwayatSetor = AjuanTabungan::where('jenis', 'setor')
        ->where('status', 'success')
        ->with('user')
        ->orderBy('created_at', 'desc')
        ->get();

    // Riwayat semua ajuan yang disetujui guru (status success)
    $riwayatSetujui = AjuanTabungan::where('status', 'success')
        ->with('user')
        ->orderBy('updated_at', 'desc')
        ->get();

    return view('admin.riwayat', compact('riwayatSetor', 'riwayatSetujui'));
}
}
