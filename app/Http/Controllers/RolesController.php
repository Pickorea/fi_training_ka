<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::all();

        return view('acessManagement.roles.index', compact('roles'));
    }

    public function create()
    {
        $this->authorize('create', Role::class);

        return view('acessManagement.roles.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name|max:255',
        ]);

        $role = Role::create([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function show(Role $role)
    {
        $this->authorize('view', $role);

        return view('acessManagement.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        return view('acessManagement.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
        ]);

        $role->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
