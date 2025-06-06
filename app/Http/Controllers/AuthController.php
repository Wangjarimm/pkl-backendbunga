<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    // use Illuminate\Validation\ValidationException;

    public function register(Request $request)
    {
        try {
            $request->validate([
                'va' => 'nullable|unique:users,va|exists:siswas,va',
                'username' => 'nullable|unique:users,username',
                'password' => 'required|min:6',
                'nis' => 'nullable|unique:users,nis|exists:siswas,nis' // Validasi NIS jika diisi
            ]);
    
            if (!$request->va && !$request->username) {
                return response()->json([
                    'message' => 'VA atau Username harus diisi minimal salah satu.'
                ], 422);
            }
    
            $user = User::create([
                'va' => $request->va,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'nis' => $request->nis
            ]);
    
            return response()->json(['message' => 'Registrasi berhasil', 'user' => $user], 201);
    
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required'
        ]);
    
        $user = User::where('va', $request->identifier)
                    ->orWhere('username', $request->identifier)
                    ->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'VA/Username atau password salah'], 401);
        }
    
        return response()->json(['message' => 'Login berhasil', 'user' => $user]);
    }
    
}

