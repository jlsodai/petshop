<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserRequest;
use App\Http\Resources\v1\UserResource;
use App\Models\JwtToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','create']]);
    }

    public function show()
    {
        return new UserResource(auth()->user());
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->user();
        $user->last_login_at = now();
        $user->save();

        return new UserResource($user);
    }

    public function create(UserRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        $user = User::create(
            $request->safe()
            ->merge(['password' => Hash::make($request->password)])
            ->toArray());

        $token = auth()->attempt($credentials);
        $payload = auth()->payload();

        JwtToken::create([
            'user_id' => $user->id,
            'token_title' => 'PetShop Jwt',
            'unique_id' => $payload['jti'],
            'expires_at' => $payload['exp'],
        ]);

        return (new UserResource($user))->additional([
            'success' => 1,
            "error" => null,
            "errors" => [],
            "extra" => []
        ]);
    }

    public function delete()
    {
        auth()->user()->delete();

        return response([
            'success' => 1,
            "error" => null,
            "errors" => [],
            "extra" => []
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            "success" => 1,
            "data" => [],
            "error" => null,
            "errors" => [],
            "extra" => []
        ]);
    }
}
