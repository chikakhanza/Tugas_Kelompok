<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Login user dan buat token.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek user
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        // Buat token
        $token = $user->createToken('token_login')->plainTextToken;

        // Response
        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user
        ]);
    }

    /**
     * Logout dan hapus token.
     */
    public function logout(Request $request)
    {
        // Hapus token aktif
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }

    /**
     * Ambil data user login.
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    /**
     * Update alamat user.
     */
    public function updateAddress(Request $request)
    {
        // Validasi input
        $request->validate([
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $user = $request->user();
        
        // Update alamat
        $user->update([
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        return response()->json([
            'message' => 'Alamat berhasil diperbarui',
            'user' => $user
        ]);
    }

    /**
     * Ambil alamat user.
     */
    public function getAddress(Request $request)
    {
        $user = $request->user();
        
        $address = [
            'street' => $user->street,
            'city' => $user->city,
            'state' => $user->state,
            'postal_code' => $user->postal_code,
            'country' => $user->country,
        ];

        return response()->json([
            'address' => $address
        ]);
    }

    /**
     * Register user baru.
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        // Buat token
        $token = $user->createToken('token_register')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil',
            'token' => $token,
            'user' => $user
        ], 201);
    }
}