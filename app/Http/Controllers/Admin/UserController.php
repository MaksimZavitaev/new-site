<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::with(['roles', 'permissions'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name')->mapWithKeys(function ($name) {
            return [$name => __("roles.${name}")];
        });

        $permissions = Permission::pluck('name')->mapWithKeys(function ($name) {
            return [$name => __("permissions.${name}")];
        });

        return view('admin.users.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $user->syncRoles($request->get('roles', []));
        $user->syncPermissions($request->get('permissions', []));

        return redirect()->route('admin.users.edit', $user)->withSuccess(__('users.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name')->mapWithKeys(function ($name) {
            return [$name => __("roles.${name}")];
        });

        $permissions = Permission::pluck('name')->mapWithKeys(function ($name) {
            return [$name => __("permissions.${name}")];
        });

//        dd($roles);
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->filled('password')) {
            $request->merge([
                'password' => Hash::make($request->input('password')),
            ]);
        }

        $user->update(array_filter($request->only(['name', 'password'])));
        $user->syncRoles($request->get('roles', []));
        $user->syncPermissions($request->get('permissions', []));

        return redirect()->route('admin.users.edit', $user)->withSuccess(__('users.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
