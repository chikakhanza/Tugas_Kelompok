<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Homestay;
use Illuminate\Http\Request;

class HomestayController extends Controller
{
    public function index()
    {
        return Homestay::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode' => 'required|unique:homestays',
            'tipe_kamar' => 'required',
            'harga_sewa_per_hari' => 'required|numeric',
            'fasilitas' => 'nullable|string',
            'jumlah_kamar' => 'required|integer|min:1',
            'lama_inap' => 'required|integer|min:1',
        ]);

        $data['total_bayar'] = $data['harga_sewa_per_hari'] * $data['lama_inap'];

        $homestay = Homestay::create($data);

        return response()->json($homestay, 201);
    }

    public function show($id)
    {
        $homestay = Homestay::findOrFail($id);
        return response()->json($homestay);
    }

    public function update(Request $request, $id)
    {
        $homestay = Homestay::findOrFail($id);

        $data = $request->validate([
            'tipe_kamar' => 'required',
            'harga_sewa_per_hari' => 'required|numeric',
            'fasilitas' => 'nullable|string',
            'jumlah_kamar' => 'required|integer|min:1',
            'lama_inap' => 'required|integer|min:1',
        ]);

        $data['total_bayar'] = $data['harga_sewa_per_hari'] * $data['lama_inap'];

        $homestay->update($data);

        return response()->json($homestay);
    }

    public function destroy($id)
    {
        Homestay::destroy($id);
        return response()->json(['message' => 'Homestay deleted']);
    }
}