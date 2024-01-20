<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    function readAll()
    {
        $users = User::all();

        return response()->json([
            'data' => $users,
        ], 200);
    }
}
