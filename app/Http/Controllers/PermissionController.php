<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Interview;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('handle', new Interview());
        $modules = Module::pluck('name', 'id')->toArray(); // Get modules for the dropdown
        $moduleId = $request->get('module_id');
        $permissions = Permission::when($moduleId, function ($query, $moduleId) {
                return $query->where('module_id', $moduleId);
            })
            ->with('module') // Assuming there's a 'module' relationship defined in Permission model
            ->get();

        return view('permission.permissions', compact('permissions', 'modules'));
    }

    public function create()
    {
        $this->authorize('handle', new Interview());
        $data['permissions'] = new Permission();
        $data['submitRoute'] = 'permission.store';
        $data['method']      =   'POST';
        $data['modules']     = Module::pluck('name', 'id')->toArray();
        return view('permission.form', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('handle', new Interview());
        $inputs = $request->all();
        $permission = new Permission();
        $permission->module_id = $inputs['module_id'];
        $permission->access = $inputs['access'];
        $permission->description = $inputs['description'];
        $permission->save();

        return redirect()->route('permission.index')->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        $this->authorize('handle', new Interview());
        $modules = Module::pluck('name', 'id');
        $selectedModule = $permission->module_id;
        // Return the view with necessary data
        return view('permission.editForm', [
            'permission' => $permission,
            'modules' => $modules,
            'selectedModule' => $selectedModule
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $this->authorize('handle', new Interview());
        $inputs = $request->only(['module_id', 'access', 'description']);

        // Check if the module exists or not
        $module = Module::find($inputs['module_id']);
        if (empty($module)) {
            // If module does not exist, create a new one with given name
            $module = new Module();
            $module->name = $request->module_id;
            $module->save();
        }

        // Update the permission and save the changes
        $permission->fill($inputs);
        $permission->save();

        return redirect()->route('permission.index')->with('success', 'Permission updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        $permission = Permission::find($request->permission);
        $this->authorize('delete', $permission);
        $permission->delete();
        
        return response()->json(
            ['success' => 'Permission deleted successfully.']
        );
    }

}
