<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CryptoKey;
use App\Services\CryptoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::with('vouchers')->get()->map(function ($user) {
                $user->vouchers->transform(function ($voucher) {
                    return ['id' => $voucher->id, 'code' => $voucher->voucher_code];
                });
            
                return $user;
            });

            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $is_valid = $request->validate([
            'name' => 'required',
            'nif' => 'required|digits:9'
        ]);

        if (!$is_valid) {
            return response()->json(['message' => 'Invalid request format'], 400);
        }

        $hasNif = User::where('nif', $request->nif)->first();

        if ($hasNif) {
            return response()->json(['message' => 'NIF already exists'], 400);
        }

        try {
            $cryptoService = new CryptoService();
            $keyPair = $cryptoService->generate_keys();
            $user = User::create($request->all());

            CryptoKey::create([
                'private_key' => $keyPair['private_key'],
                'public_key' => $keyPair['public_key'],
                'user_id' => $user->id
            ]);

            return response()->json(
                [
                    'user' => $user,
                    'public_key' => $keyPair['public_key']
                ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }


    /**
     * Log in the specified resource.
     */
    public function login(Request $request)
    {
        $nif = $request->nif;
        $user = User::where('nif', $nif)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $cryptoService = new CryptoService();
        $public_key = $cryptoService->get_key($user->id);

        if (!$public_key) {
            return response()->json(['message' => 'Public key not found'], 404);
        }

        return response()->json([
            'user' => $user,
            'public_key' => $public_key
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $is_valid = $request->validate([
            'name' => 'required'
        ]);

        if (!$is_valid) {
            return response()->json(['message' => 'Invalid data format in the request body'], 400);
        }

        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update($request->all());

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
