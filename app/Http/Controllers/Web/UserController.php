<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/users",
 *     summary="Get list of users",
 *     @OA\Response(
 *         response=200,
 *         description="List of users"
 *     )
 * )
 */
class UserController extends Controller
{
    public function index()
    {
        
        return response()->json([
            'users' => ['Alice', 'Bob']
        ]);
    }
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phonenumber' => 'sometimes|string|max:20' // or use phone validation package for stricter rules
        ]);

        $user->update($request->only(['name', 'email', 'phonenumber']));

        return apiResponse($user, 'Profile updated');
    }
    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048', // max 2MB
        ]);

        $user = $request->user();
        $path = $request->file('image')->store('profile_images', 'public');

        $user->profile_image = $path;
        $user->save();

        return response()->json(['message' => 'Image uploaded', 'path' => asset('storage/' . $path)]);
    }
}
