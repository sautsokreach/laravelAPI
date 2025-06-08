<?php

namespace App\Http\Controllers\Api;

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
}
