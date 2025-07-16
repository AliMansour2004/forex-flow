<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    private const VALIDATION_RULES = [
        'user_name' => 'required',
        'password' => 'required',
    ];

    public function loginUser(Request $request)
    {
        try {

            $validateUser = Validator::make($request->all(), self::VALIDATION_RULES);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateUser->errors()
                ], 422);
            }

            $credentials = [
                'user_name' => $request->input('user_name'),
                'password' => $request->input('password'),
            ];

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials',
                ], 401);
            }

            $user = Auth::user();
            $user_role = $user->roles->first()->name;
            $user_permission = $user_role == 'admin' ? 'manage' : 'read';
            if ($user_role == 'admin') {
                $user_permission = 'manage';
                $subject = "all";
            } elseif ($user_role == 'broker') {
                $user_permission = 'manage';
                $subject = "broker";
            } else {
                $user_permission = 'read';
                $subject = "member";
            }

            if ($user->is_active == 0) {
                Auth::logout(); // Log out the user
                return response()->json([
                    'status' => false,
                    'message' => 'Please renew your subscription',
                ], 403);
            }

            $token = $user->createToken("API_TOKEN")->plainTextToken;

            $data = [
                'id' => $user->id,
                'fullName' => $user->first_name . '' . $user->last_name,
                'username' => $user->user_name,
                'avatar' => '/images/avatars/avatar-1.png',
                'email' => $user->email,
                'role' => $user_role,
            ];

            return response()->json([
                'userAbilityRules' => $user_role != 'broker'
                    ? [["action" => $user_permission, "subject" => $subject]]
                    : [
                        ["action" => $user_permission, "subject" => $subject],
                        ["action" => "read", "subject" => "member"]
                    ],
                'accessToken' => $token,
                'userData' => $data
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['status' => false,
                'message' => 'Internal server error',], 500);
        }
    }
}
