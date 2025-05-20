<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AjuanTabungan;
use App\Models\Tabungan;
use Illuminate\Support\Facades\Auth;

class AjuanController extends Controller
{
    public function setujui($id)
    {
        $ajuan = AjuanTabungan::findOrFail($id);

        if ($ajuan->status !== 'pending') {
            return redirect()->back()->with('error', 'Ajuan sudah diproses sebelumnya.');
        }

        $ajuan->status = 'success';
        $ajuan->approved_by = Auth::id();
        $ajuan->save();

        $jumlah = $ajuan->jenis === 'tarik' ? -abs($ajuan->jumlah) : abs($ajuan->jumlah);

        Tabungan::create([
            'user_id' => $ajuan->user_id,
            'jumlah' => $jumlah,
        ]);

        return redirect()->back()->with('success', 'Ajuan berhasil disetujui!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:setor,tarik',
            'jumlah' => 'required|integer|min:1000',
        ]);

        AjuanTabungan::create([
            'user_id' => Auth::id(),
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Ajuan berhasil dikirim.');
    }

    public function tolak($id)
    {
        $ajuan = AjuanTabungan::findOrFail($id);

        // Cek status dulu, hanya bisa tolak jika status pending
        if ($ajuan->status !== 'pending') {
            return redirect()->back()->with('error', 'Ajuan sudah diproses sebelumnya.');
        }

        $ajuan->status = 'rejected'; // atau 'tolak' kalau mau
        $ajuan->save();

        return redirect()->back()->with('success', 'Ajuan berhasil ditolak.');
    }
}
