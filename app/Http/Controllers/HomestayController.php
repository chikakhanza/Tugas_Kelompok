<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use Illuminate\Http\Request;

class HomestayController extends Controller
{
    // Tampilkan semua homestay
    public function index()
    {
        $homestays = Homestay::all();
        return view('homestays.index', compact('homestays'));
    }

    // Form tambah homestay
    public function create()
    {
        $users = \App\Models\User::all();
        $homestays = \App\Models\Homestay::all();
        return view('homestays.create', compact('users', 'homestays'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:homestays',
            'tipe_kamar' => 'required',
            'harga_sewa_per_hari' => 'required|numeric',
            'lama_inap' => 'required|integer|min:1',
        ]);

        $total_bayar = $request->harga_sewa_per_hari * $request->lama_inap;

        Homestay::create([
            'kode' => $request->kode,
            'tipe_kamar' => $request->tipe_kamar,
            'harga_sewa_per_hari' => $request->harga_sewa_per_hari,
            'lama_inap' => $request->lama_inap,
            'total_bayar' => $total_bayar,
        ]);

        return redirect()->route('homestays.index')->with('success', 'Homestay berhasil ditambahkan.');
    }

    // Tampilkan detail homestay
    public function show($id)
    {
        $homestay = Homestay::findOrFail($id);
        return view('homestays.show', compact('homestay'));
    }

    // Form edit homestay
    public function edit($id)
    {
        $homestay = Homestay::findOrFail($id);
        return view('homestays.edit', compact('homestay'));
    }

    // Simpan update data
    public function update(Request $request, $id)
    {
        $homestay = Homestay::findOrFail($id);

        $request->validate([
            'tipe_kamar' => 'required',
            'harga_sewa_per_hari' => 'required|numeric',
            'lama_inap' => 'required|integer|min:1',
        ]);

        $total_bayar = $request->harga_sewa_per_hari * $request->lama_inap;

        $homestay->update([
            'tipe_kamar' => $request->tipe_kamar,
            'harga_sewa_per_hari' => $request->harga_sewa_per_hari,
            'lama_inap' => $request->lama_inap,
            'total_bayar' => $total_bayar,
        ]);

        return redirect()->route('homestays.index')->with('success', 'Homestay berhasil diperbarui.');
    }

    // Hapus data homestay
    public function destroy($id)
    {
        $homestay = Homestay::findOrFail($id);
        $homestay->delete();

        return redirect()->route('homestays.index')->with('success', 'Homestay berhasil dihapus.');
    }
}
