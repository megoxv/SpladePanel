<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Nwidart\Modules\Facades\Module;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FileUploads\HandleSpladeFileUploads;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use ZipArchive;

class PluginController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create plugins', ['only' => ['create', 'store']]);
        $this->middleware('can:read plugins',   ['only' => ['index']]);
        $this->middleware('can:update plugins',   ['only' => ['activate', 'deactivate']]);
        $this->middleware('can:delete plugins',   ['only' => ['delete']]);
    }

    public function index(Request $request)
    {
        return view('dashboard.plugins.index');
    }

    public function create(Request $request)
    {
        return view('dashboard.plugins.create');
    }

    public function store(Request $request)
    {
        HandleSpladeFileUploads::forRequest($request);

        $request->validate([
            'file' => 'required|file|mimes:zip',
        ]);

        $zip = new ZipArchive;
        $res = $zip->open($request->file('file'));

        if ($res === TRUE) {
            $zip->extractTo(Module::getPath());
            $zip->close();
            Toast::title(__('main.the_plugin_has_been_successfully_uploaded'))->autoDismiss(3);
            return redirect()->route('dashboard.plugins.index');
        } else {
            Toast::warning(__('main.sorry,_please_upload_the_plugin_again'))->autoDismiss(3);
            return redirect()->back();
        }
    }

    public function activate($plugin)
    {
        Module::findOrFail($plugin)->enable();
        $plugin = Module::findOrFail($plugin);
        $module = $plugin->get('alias');

        Artisan::call('module:migrate ' . $plugin->getName());

        $permissions = ['create', 'read', 'update', 'delete'];

        foreach ($permissions as $permission)
            $permission_ids[] = Permission::firstOrCreate([
                'name' => $permission . ' ' . $module,
                'guard_name' => 'web'
            ])->id;

        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'super-admin');
        })->get();

        Role::where('name', 'super-admin')->first()->givePermissionTo($permission_ids);

        foreach ($users as $user) {
            $user->syncPermissions($permission_ids);
        }

        Toast::title(__('main.the_plugin_has_been_activated'))->autoDismiss(3);
        return redirect()->back();
    }

    public function deactivate($plugin)
    {
        Module::findOrFail($plugin)->disable();
        $plugin = Module::findOrFail($plugin);
        $module = $plugin->get('alias');

        $permissions = ['create', 'read', 'update', 'delete'];

        foreach ($permissions as $permission) {
            Permission::where('name', $module . ' ' . $permission)->delete();
        }

        Artisan::call('module:migrate-reset ' . $plugin->getName());
        Toast::title(__('main.the_plugin_has_been_deactivated'))->autoDismiss(3);
        return redirect()->back();
    }

    public function delete($plugin)
    {
        Module::findOrFail($plugin)->delete();

        Toast::title(__('main.the_plugin_has_been_deleted'))->autoDismiss(3);
        return redirect()->back();
    }
}
