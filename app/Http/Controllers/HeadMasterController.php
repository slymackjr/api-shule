<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HeadMasterController extends Controller
{
    public function headMasterDetails(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Fetch the teacher data except the password
        $userData = Teacher::where('id', $user->id)
            ->first()
            ->makeHidden(['password']);

        if ($userData) {
            return response()->json([
                'success' => true,
                'data' => $userData
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }
    }

     // Function to update the headmaster's profile
     public function updateHeadMasterProfile(Request $request, int $id)
    {
        // Validate the incoming request
        // Validate the request
    $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:teachers,email,'.$id,
            'phone_number' => 'required|string|max:15',
            'region' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages(),
            ], 422);
        }

        try {
             // Find the teacher by ID
            $teacher = Teacher::findOrFail($id);
            // Update teacher details in the database
            $teacher->update([
                'first_name' => $request->input('first_name'),
                /* 'middle_name' => $request->input('middle_name'), */
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                /* 'region' => $request->input('region'),
                'district' => $request->input('district'),
                'ward' => $request->input('ward'), */
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => $teacher
            ],200);

        } catch (\Exception $e) {
            // Return error if something goes wrong
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile: ' . $e->getMessage(),
            ], 500);
        }
    }

}
