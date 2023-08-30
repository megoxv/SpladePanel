<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Tables\Users;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create users', ['only' => ['create', 'store']]);
        $this->middleware('can:read users',   ['only' => ['show', 'index']]);
        $this->middleware('can:update users',   ['only' => ['edit', 'update']]);
        $this->middleware('can:delete users',   ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => Users::class,
            'permissions' => Permission::pluck('name', 'id')->toArray(),
            'roles' => Role::pluck('name', 'id')->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => "nullable|mimes:jpg,jpeg,png|max:1024",
            'name' => "required|string|max:255",
            'username' => "required|unique:users,username",
            'email' => "required|unique:users,email",
            'bio' => "nullable|max:255",
            'status' => "required",
            'password' => "required|min:8|max:190",
        ]);

        $user = User::create([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "bio" => $request->bio,
            "status" => $request->status,
            "password" => Hash::make($request->password),
            "email_verified_at" => now(),
        ]);

        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        if (isset($request->photo)) {
            $user->updateProfilePhoto($request->photo);
        }

        Toast::title(__('main.user_created'))->autoDismiss(3);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'permissions' => Permission::pluck('name', 'id')->toArray(),
            'roles' => Role::pluck('name', 'id')->toArray(),
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'photo' => "nullable|mimes:jpg,jpeg,png|max:1024",
            'name' => "required|string|max:255",
            'username' => "required|unique:users,username," . $user->id,
            'email' => "required|unique:users,email," . $user->id,
            'bio' => "nullable|max:255",
            'status' => "required",
            'new_password' => "nullable|min:8|max:190",
        ]);

        if (isset($request->photo)) {
            $user->updateProfilePhoto($request->photo);
        }

        $user->forceFill([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'bio' => $request->bio,
            'status' => $request->status,
        ])->save();

        if ($request->new_password != null) {
            $user->update([
                "new_password" => Hash::make($request->new_password)
            ]);
        }

        $request->validate([
            'roles' => "required|array",
            'roles.*' => "required|exists:roles,id",
        ]);

        $user->syncRoles($request->roles);
        $user->givePermissionTo($request->permissions);

        Toast::title(__('main.user_updated'))->autoDismiss(3);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::transaction(function () use ($user) {
            $user->deleteProfilePhoto();
            $user->tokens->each->delete();
            $user->delete();
        });

        Toast::title(__('main.user_deleted'))->autoDismiss(3);
        return redirect()->back();
    }
}
