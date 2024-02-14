<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('handle', new Interview());
        $users                  = User::with('roles');

        $data['users']          = $users->get();
        return view('user.user', $data);
    }

    public function create()
    {
        $this->authorize('handle', new Interview());
        $data['user']           =   new User();
        $data['submitRoute']    =   'user.store';
        $data['method']         =   'POST';
        return view('user.createForm',$data);
    }

    public function store(UserRequest $request)
    {
        $this->authorize('handle', new Interview());
        $inputs                     = $request->all();
        $user                       = new User();
        $user->name                 = $inputs['name'];
        $user->email                = $inputs['email'];
        $hash           = Hash::make('Welcome@123');
        $user->password = $hash;
        $user->save();
        return back()->with('success', 'User Created');
    }

    public function edit($id)
    {
        $this->authorize('handle', new Interview());
        $data['user']           =   User::find($id);
        $data['roles']          =   Role::all();
        $data['userTypes']      =   config('employee.userTypes');

        return view('user.userForm', $data);
    }

    public function update(UserRequest $request, $id)
    {
        $this->authorize('handle', new Interview());
        $inputs                     = $request->all();
        $user                       = User::withoutGlobalScope('is_active')->with('employee')->find($id);
        $user->name                 = $inputs['name'];
        $user->email                = $inputs['email'];
        $user->save();
        return redirect()->back()->with('success', 'User Updated');
    }

    public function assignRoles(Request $request)
    {
        $this->authorize('handle', new Interview());
        $userid         = $request->input('user');
        $user           = User::find($userid);
        $roles          = $request->input('role'); // array of role ids
        if (empty($roles)) {
            $roles      = array();
        }
        $user->roles()->sync($roles);
        return redirect()->back()->with('success', 'Role Assigned Successful');
    }

 
}
