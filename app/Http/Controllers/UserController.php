<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('user.index', [
            'users' => User::orderByDesc('id')->paginate(10)
        ]);
    }

    public function create(): View
    {
        return view('user.create', [
            'roles' => Role::orderBy('name')->get()
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->assignRole($request->roles);
        return redirect()
            ->route('user.index')
            ->withSuccess('User created successfully.');
    }

    public function show(User $user): View
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user): View
    {
        // prevent editing another Super Admin
        if ($user->hasRole('Super Admin') && $user->id !== auth()->id()) {
            abort(403, 'You do not have permission to modify this user.');
        }

        return view('user.edit', [
            'user'       => $user,
            'roles'      => Role::orderBy('name')->get(),
            'userRoles'  => $user->roles->pluck('name')->toArray()
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        // update password only if provided
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        $user->syncRoles($request->roles);

        return redirect()
            ->back()
            ->withSuccess('User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        // block deleting Super Admin or self
        if ($user->hasRole('Super Admin') || $user->id === auth()->id()) {
            abort(403, 'Gabisa Delete Super Admin Atau Role Sendiri.');
        }

        $user->syncRoles([]);
        $user->delete();

        return redirect()
            ->route('user.index')
            ->withSuccess('User deleted successfully.');
    }
}
