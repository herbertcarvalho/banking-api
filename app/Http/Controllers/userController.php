<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterUserRequest;

class userController extends Controller
{
    public $successStatus = 200;

    public function show()
    {
        return auth()->user();
    }

    public function register(RegisterUserRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        User::create($input);
        return response()->json(['success' => true], $this->successStatus);
    }
}
