<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function authenticateTeacher(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Attempt to authenticate the teacher
    if (Auth::guard('teacher')->attempt($request->only('email', 'password'))) {
        $teacher = Auth::guard('teacher')->user();
        $token = $teacher->createToken('teacher_token', ['Teacher'])->plainTextToken;

        // Set the token as an HttpOnly, Secure cookie
        $cookie = cookie('auth_token', $token, 60 * 24 * 7, '/', null, true, true, false, 'lax');

        return response()->json([
            'teacher' => $teacher,
            'token' => $token,
        ])->withCookie($cookie);
    }

    return response()->json(['error' => 'Invalid credentials'], 401);
}

    
    public function teacherDetails(Request $request) {
        // This method will be protected by middleware to ensure the teacher is authenticated
        $teacher = $request->user();

        return response()->json(['data' => $teacher]);
    }
    
    // logout a user method
    public function logout(Request $request) {
       // Revoke the token
       $request->user()->currentAccessToken()->delete();

       // Forget the token cookie
       $cookie = cookie()->forget('auth_token');

       return response()->json(['message' => 'Logged out successfully!'])->withCookie($cookie);
    }
}
