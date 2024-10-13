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
    // Validate the incoming request data
    $validator = Validator::make($request->all(), [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json([
            'response' => false,
            'message' => 'Validation failed.',
            'errors' => $validator->messages(),
        ], 422);
    }

    // Find the teacher by email
    $teacher = Teacher::where('email', $request->email)->first();

    // Check if teacher exists and password is correct
    if (!$teacher) {
        return response()->json([
            'response' => false,
            'message' => 'Invalid credentials.',
            'errors' => [
                'email' => ['No account found with this email address.']
            ]
        ], 401);
    }

    if (!Hash::check($request->password, $teacher->password)) {
        return response()->json([
            'response' => false,
            'message' => 'Invalid credentials.',
            'errors' => [
                'password' => ['The provided password is incorrect.']
            ]
        ], 401);
    }

    // Create a token for the authenticated teacher
    $token = $teacher->createToken('teacher_token', ['Teacher'])->plainTextToken;

    // Return success response with teacher info and token
    return response()->json([
        'response' => true,
        'message' => 'Authentication successful.',
        'teacher' => $teacher,
        'token' => $token,
    ], 200);
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
