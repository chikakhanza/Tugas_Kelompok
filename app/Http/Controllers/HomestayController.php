<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use Illuminate\Http\Request;

class HomestayController extends Controller
{
    public function index()
    {
        $homestays = Homestay::all();
        return view('homestays.index', compact('homestays'));
    }

    public function create()
    {
        return view('homestays.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:homestays',
            'tipe_kamar' => 'required',
            'harga_sewa_per_hari' => 'required|numeric',
            'fasilitas' => 'nullable|string',
            'jumlah_kamar' => 'required|integer|min:1',
            'lama_inap' => 'required|integer|min:1',
        ]);

        $total_bayar = $request->harga_sewa_per_hari * $request->lama_inap;

        Homestay::create([
            'kode' => $request->kode,
            'tipe_kamar' => $request->tipe_kamar,
            'harga_sewa_per_hari' => $request->harga_sewa_per_hari,
            'fasilitas' => $request->fasilitas,
            'jumlah_kamar' => $request->jumlah_kamar,
            'lama_inap' => $request->lama_inap,
            'total_bayar' => $total_bayar,
        ]);

        return redirect()->route('homestays.index')->with('success', 'Homestay berhasil ditambahkan.');
    }

    public function show($id)
    {
        $homestay = Homestay::findOrFail($id);
        return view('homestays.show', compact('homestay'));
    }

    public function edit($id)
    {
        $homestay = Homestay::findOrFail($id);
        return view('homestays.edit', compact('homestay'));
    }

    public function update(Request $request, $id)
    {
        $homestay = Homestay::findOrFail($id);

        $request->validate([
            'tipe_kamar' => 'required',
            'harga_sewa_per_hari' => 'required|numeric',
            'fasilitas' => 'nullable|string',
            'jumlah_kamar' => 'required|integer|min:1',
            'lama_inap' => 'required|integer|min:1',
        ]);

        $total_bayar = $request->harga_sewa_per_hari * $request->lama_inap;

        $homestay->update([
            'tipe_kamar' => $request->tipe_kamar,
            'harga_sewa_per_hari' => $request->harga_sewa_per_hari,
            'fasilitas' => $request->fasilitas,
            'jumlah_kamar' => $request->jumlah_kamar,
            'lama_inap' => $request->lama_inap,
            'total_bayar' => $total_bayar,
        ]);

        return redirect()->route('homestays.index')->with('success', 'Homestay berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Homestay::destroy($id);
        return redirect()->route('homestays.index')->with('success', 'Homestay berhasil dihapus.');
    }
}
