<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return response()->json($users);
    }
    public function store(StoreUserRequest $storeUserRequest){
        $data = $storeUserRequest->validated();
        User::create($data);

        return response()->json("User Created !");
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
