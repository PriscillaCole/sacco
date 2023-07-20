<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Utils;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\AdminRoleUser;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function register(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return Utils::apiError($validator->errors()->first());
        }
    
        // Create and save the new user
        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->username = $request->input('username'); // Assuming username is the same as email
            $user->password = Hash::make($request->input('password'));
            $user->save();
            
            // Assign a default role to the user (e.g., AdminRoleUser with ID 3)
            $role = new AdminRoleUser();
            $role->user_id = $user->id;
            $role->role_id = 3;
            $role->save();
        } catch (\Throwable $th) {
            return Utils::apiError('Error saving user. ' . $th->getMessage());
        }
    
        // Generate JWT token and attach it to the user object
        JWTAuth::factory()->setTTL(60 * 24 * 30 * 12);
        $token = auth('api')->attempt([
            'email' => $user->email,
            'password' => $request->input('password'),
        ]);
        $user->token = $token;
    
        return Utils::apiSuccess($user, 'User registered successfully.');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function login(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return Utils::apiError($validator->errors()->first());
        }
    
        // Check if the user exists
        $user = User::where('email', $request->input('email'))->first();
    
        if (!$user) {
            return Utils::apiError('User not found.');
        }
    
        // Verify the user's password
        if (!Hash::check($request->input('password'), $user->password)) {
            return Utils::apiError('Invalid credentials.');
        }
    
        // Generate JWT token and attach it to the user object
        JWTAuth::factory()->setTTL(60 * 24 * 30 * 12);
        $token = auth('api')->attempt([
            'email' => $user->email,
            'password' => $request->input('password'),
        ]);
        $user->token = $token;
    
        return Utils::apiSuccess($user, 'Login successful.');
    }
    

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}