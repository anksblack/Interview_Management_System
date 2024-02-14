<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('handle', new Interview());

        $data['roles'] = Role::all();
        return view('role.roles', $data);
    }

    public function create(Request $request)
    {
        $this->authorize('handle', new Interview());
        return view('role.createRole');
    }

    public function store(Request $request)
    {
        $this->authorize('handle', new Interview());
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|unique:modules|max:255',
            // Add more validation rules if needed
        ]);

        // Create a new module instance
        Role::create($validatedData);

        return redirect()->route('role.index')
            ->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $this->authorize('handle', new Interview());
        $data['role']           =   $role;
        $data['submitRoute']    =   array('role.update', $role->id);
        $permissions            =   Permission::orderbyRaw("FIELD(access, 'view', 'insert', 'update',
                                            'delete')")
                                        ->get()
                                        ->load('module')
                                        ->groupBy('module_name');
        $data['permissions']    =   $permissions;
        return view("role.assignPermissionForm", $data);
    }

    public function update(Role $role, RoleRequest $request)
    {
        $this->authorize('handle', new Interview());
        $inputs                     =   $request->except(["_token"]);
        $permissions                =   $inputs['permission'] ?? [];
        $role->permissions()->sync($permissions);
        Session::flash('success', 'Role permissions updated!');
        return redirect()->back();
    }

}
