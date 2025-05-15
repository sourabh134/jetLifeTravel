<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;
use App\Models\User;


class UserController extends Controller
{
    public function register()
    {
        return view('front.register');
    }

    public function login()
    {
        return view('front.login');
    }

    public function storeUser(Request $request)
    {
        if($request->userType==1){
            $data = $request->only(['firstName', 'lastName', 'email', 'password', 'phoneNumber', 'userType']);
        }else{
            $data = $request->only(['firstName', 'lastName','companyName','employeeId', 'email', 'password', 'phoneNumber', 'userType']);
        }

        // Check for existing user with same email and userType
        $existingUser = User::where('email', $data['email'])
            ->where('userType', $data['userType'])
            ->count();
        if($existingUser == 0){
            $data['password'] = Hash::make($data['password']);
            UserService::create($data);
            return response()->json(['message' => 'Successfully Submitted'], 200);
        }else{
            return response()->json(['message' => 'Email already exist'], 200);
        }
    }

    public function userlogin(Request $request){
        $data = $request->only(['email', 'password','userType']);

    }
}
