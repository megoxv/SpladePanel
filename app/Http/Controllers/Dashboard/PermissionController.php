<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Tables\Permissions;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create permissions', ['only' => ['create', 'store']]);
        $this->middleware('can:read permissions',   ['only' => ['show', 'index']]);
        $this->middleware('can:update permissions',   ['only' => ['edit', 'update']]);
        $this->middleware('can:delete permissions',   ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.permissions.index', [
            'permissions' => Permissions::class,
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'roles' => 'nullable|array|min:1',
        ]);

        $permission = Permission::create($validatedData);
        $permission->syncRoles($request->roles);

        Toast::title(__('main.permission_created'))->autoDismiss(3);
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
    public function edit(Permission $permission)
    {
        return view('dashboard.permissions.edit', [
            'permission' => $permission,
            'roles' => Role::pluck('name', 'id')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'roles' => 'nullable|array|min:1',
        ]);

        $permission->update($validatedData);
        $permission->syncRoles($request->roles);

        Toast::title(__('main.permission_updated'))->autoDismiss(3);
        return redirect()->route('dashboard.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        Toast::title(__('main.permission_deleted'))->autoDismiss(3);
        return redirect()->back();
    }
}
