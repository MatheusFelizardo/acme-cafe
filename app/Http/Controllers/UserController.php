<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CryptoKey;
use App\Services\CryptoService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
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
        $request->validate([
            'name' => 'required',
            'nif' => 'required|digits:9', 
            'email' => 'required|email'
        ]);

        $hasNif = User::where('nif', $request->nif)->first();
        $hasEmail = User::where('email', $request->email)->first();

        if ($hasNif) {
            return response()->json(['message' => 'NIF already exists'], 400);
        }

        if ($hasEmail) {
            return response()->json(['message' => 'Email already exists'], 400);
        }

        try {
            $cryptoService = new CryptoService();
            $keyPair = $cryptoService->generateKeys();
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
    public function login(Request $request)
    {
        $nif = $request->nif;
        $user = User::where('nif', $nif)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $public_key = $request->public_key;
        $cryptoService = new CryptoService();

        $has_valid_key = $cryptoService->validateKey($public_key, $user->id);

        if (!$has_valid_key) {
            return response()->json(['message' => 'Invalid public key'], 401);
        }

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
