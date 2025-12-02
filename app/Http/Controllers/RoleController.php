<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-role|edit-role|delete-role', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-role', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('roles.index', [
            'roles' => Role::with('permissions')
                ->orderByDesc('id')
                ->paginate(10),
            
        ]);
    }

    public function create(): View
    {
        return view('roles.create', [
            'permissions' => Permission::orderBy('name')->get(),
        ]);
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::create(['name' => $request->name]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);

        return redirect()
            ->route('roles.index')
            ->withSuccess('Role created successfully.');
    }


    public function show(): View
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role): View
    {
        if ($role->name === 'Super Admin') {
            abort(403, 'This role cannot be modified.');
        }

        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::orderBy('name')->get(),
            'rolePermissions' => $role->permissions->pluck('id')->toArray()
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->update(['name' => $request->name]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);

        return redirect()
            ->back()
            ->withSuccess('Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($role->name === 'Super Admin') {
            abort(403, 'This role cannot be deleted.');
        }

        if (auth()->user()->hasRole($role->name)) {
            abort(403, 'You cannot delete a role assigned to yourself.');
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->withSuccess('Role deleted successfully.');
    }
}
