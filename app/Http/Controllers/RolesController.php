<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesController extends Controller
{
     public function index()
    {
        if (auth()->user()->hasRole('administrator')) {
           $roles = Role::all();
          return view('accessManagement.roles.index', compact('roles'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function create()
{
    if (auth()->user()->hasPermissionTo('roles.create')) {
        return view('accessManagement.roles.create');
    } else {
        abort(403, 'Unauthorized action.');
    }
}


public function store(Request $request)
{
    if (auth()->user()->hasPermissionTo('roles.create')) {

        $this->authorize('roles.create', Role::class);

        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name|max:255',
        ]);

        $role = Role::create([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('access-management.roles.index')
            ->with('success', 'Role created successfully.');
    } else {
        abort(403, 'Unauthorized action.');
    }
}



    public function show(Role $role)
    {
        $this->authorize('view', $role);

        return view('accessManagement.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        if (auth()->user()->hasRole('administrator')) {
            // Allow access to the protected routes
        } else {
            abort(403, 'Unauthorized action.');
        }

        return view('accessManagement.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        if (auth()->user()->hasRole('administrator')) {
            // Allow access to the protected routes
        } else {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
        ]);

        $role->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('access-management.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if (auth()->user()->hasRole('administrator')) {
            // Allow access to the protected routes
        } else {
            abort(403, 'Unauthorized action.');
        }

        $role->delete();

        return redirect()->route('access-management.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
