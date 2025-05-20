<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TabunganController extends Controller
{
    public function setor(Request $request)
    {
        Tabungan::create([
            'user_id' => Auth::id(),

            'jumlah' => $request->jumlah,
            'tipe' => 'setor',
        ]);

        return redirect()->back()->with('success', 'Setor berhasil');
    }
}
