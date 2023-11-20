<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return response()->json($users);
    }
    public function store(StoreUserRequest $storeUserRequest){
        $data = $storeUserRequest->validated();
        $user = User::create($data);

//        instantly login without requiring user to login with their credential
//        auth()->login($user);

        return response()->json("User has been created and logged in!");
    }

//    Log out user from account
    public function logout(){

    }
    public function show(){

    }
    public function edit(){

    }
    public function update(UpdateUserRequest $updateUserRequest, User $user){
        $user->update($updateUserRequest->validated());
        return response()->json("User Updated Successfully!");
    }
    public function destroy(User $user)
    {
        if(!$user){
            return response()->json(['message' => 'User not found !'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully !'], 200);
    }

}
