<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
            ], [
                'email.unique' => 'Mail already exists.',
            ]);

            $validatedData['password'] = bcrypt($request->password);

            $user = User::create($validatedData);

            return response()->json(['user' => $user], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function login(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $validatedData['email'])->first();

            if (!$user || !Hash::check($validatedData['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }
}
