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
        $ajuan->status = 'success';
        $ajuan->save();

        // Jika ajuan tarik, jumlah disimpan negatif supaya saldo berkurang
        $jumlah = $ajuan->jenis === 'tarik' ? -abs($ajuan->jumlah) : abs($ajuan->jumlah);

        \App\Models\Tabungan::create([
            'user_id' => $ajuan->user_id,
            'jumlah' => $jumlah,
        ]);

        return back()->with('success', 'Ajuan berhasil disetujui!');
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

        return back()->with('success', 'Ajuan berhasil dikirim.');
    }
    public function tolak($id)
{
    $ajuan = AjuanTabungan::findOrFail($id);
    $ajuan->status = 'rejected';  // atau 'tolak' sesuai kebutuhan
    $ajuan->save();

    return redirect()->back()->with('success', 'Ajuan berhasil ditolak.');
}

}
