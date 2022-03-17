<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function showUsers(){
        $roles = Role::all();
        $users = User::with(['role']);
        return view('users.index', [
            'roles' => $roles,
            'users' => $users
        ]);
    }

    public function filter(Role $roles){
        return view('users.index', [
            'users' => $roles->users,
            'roles' => Role::all(),
        ]);
    }

    public function allUsers(){
        if(Gate::allows('admin')){
            return UserResource::collection(User::all());
        }
        return abort(403, 'Только для администратора');
    }

    public function filterRole(Role $role){
        $users = UserResource::collection($role->users);

        return compact('users');
    }

    public function edit(User $user, Role $role){
        return view('users.edit', ['user' => $user, 'roles' => $role::all()]);
    }

    public function update(Request $request, User $user){
        $user->role_id = $request->data;
        $user->save();
        return new UserResource($user);
    }
}
