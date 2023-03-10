<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('administrator')) {
            $users = User::all();
            return view('accessManagement.users.index', compact('users'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasPermissionTo('users.create')) {
            $roles = Role::pluck('name', 'id');
    
            return view('accessManagement.users.create', compact('roles'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    
    

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->hasRole('administrator')) {
            // Allow creating a new user
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email|max:255',
                'password' => 'required|string|min:8|confirmed',
                'roles' => 'required|array',
            ]);
    
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
    
            $user->assignRole($validatedData['roles']);
    
            return redirect()->route('access-management.users.index')
                ->with('success', 'User created successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $user = User::findOrFail($id);

    if (auth()->user()->hasRole('administrator')) {
        // user has 'admin' role, allow access to edit page
        $roles = Role::pluck('name', 'id');
        return view('accessManagement.users.edit', compact('user', 'roles'));
    } else {
        // user does not have 'admin' role, deny access
        abort(403, 'Unauthorized action.');
    }
}




    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (auth()->user()->hasRole('administrator')) {
            // Allow access to the protected routes
        } else {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($id);

        // $this->authorize('update', $user);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $id . '|max:255',
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'roles' => 'required|array',
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        if (isset($validatedData['password'])) {
            $user->update(['password' => Hash::make($validatedData['password'])]);
        }

        $user->syncRoles($validatedData['roles']);

        return redirect()->route('access-management.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasRole('administrator')) {
            // Allow access to the protected routes
        } else {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($id);

        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}