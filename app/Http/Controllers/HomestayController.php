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
        ]);

        Homestay::create([
            'kode' => $request->kode,
            'tipe_kamar' => $request->tipe_kamar,
            'harga_sewa_per_hari' => $request->harga_sewa_per_hari,
            'fasilitas' => $request->fasilitas,
            'jumlah_kamar' => $request->jumlah_kamar,
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
        ]);

        $homestay->update([
            'tipe_kamar' => $request->tipe_kamar,
            'harga_sewa_per_hari' => $request->harga_sewa_per_hari,
            'fasilitas' => $request->fasilitas,
            'jumlah_kamar' => $request->jumlah_kamar,
        ]);

        return redirect()->route('homestays.index')->with('success', 'Homestay berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Homestay::destroy($id);
        return redirect()->route('homestays.index')->with('success', 'Homestay berhasil dihapus.');
    }

    public function laporan(Request $request)
    {
        $tipe_kamar = $request->input('tipe_kamar');

        $query = Homestay::query();

        if ($tipe_kamar) {
            $query->where('tipe_kamar', $tipe_kamar);
        }

        $homestays = $query->get();
        $tipeKamars = Homestay::select('tipe_kamar')->distinct()->pluck('tipe_kamar');

        return view('homestays.laporan', compact('homestays', 'tipeKamars', 'tipe_kamar'));
    }
}
