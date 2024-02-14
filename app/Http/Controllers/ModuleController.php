<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $this->authorize('handle', new Interview());
        $modules = Module::all();
        return view('module.index', compact('modules'));
    }

    public function create()
    {
        return view('module.create');
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
        Module::create($validatedData);

        return redirect()->route('modules.index')
            ->with('success', 'Module created successfully.');
    }


    public function edit(Module $module)
    {
        return view('module.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $this->authorize('handle', new Interview());
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|unique:modules,name,' . $module->id . '|max:255',
            // Add more validation rules if needed
        ]);

        // Update the module
        $module->update($validatedData);

        return redirect()->route('modules.index')
            ->with('success', 'Module updated successfully.');
    }

    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->route('modules.index')
            ->with('success', 'Module deleted successfully.');
    }
}