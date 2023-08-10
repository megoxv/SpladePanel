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
            Toast::title('The plugin has been successfully uploaded')->autoDismiss(3);
            return redirect()->route('dashboard.index');
        } else {
            Toast::warning('Sorry, please upload the plugin again')->autoDismiss(3);
            return redirect()->back();
        }
    }

    public function activate($plugin)
    {
        Module::findorFail($plugin)->enable();
        $plugin = Module::findorFail($plugin);
        $module = $plugin->get('alias');

        $permissions = ['create', 'read', 'update', 'delete'];

        foreach ($permissions as $permission)
            $permission_ids[] = Permission::firstOrCreate([
                'name' => $module . ' ' . $permission,
                'table' => $module
            ])->id;

        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'super-admin');
        })->get();

        Role::where('name', 'super-admin')->first()->givePermissionTo($permission_ids);

        foreach ($users as $user) {
            $user->syncPermissions($permission_ids);
        }

        Artisan::call('module:migrate ' . $plugin->getName(), ['--force' => true]);
        Toast::title('The plugin has been activated')->autoDismiss(3);
        return redirect()->back();
    }

    public function deactivate($plugin)
    {
        Module::findorFail($plugin)->disable();
        $plugin = Module::findorFail($plugin);
        $module = $plugin->get('alias');

        $permissions = ['create', 'read', 'update', 'delete'];

        foreach ($permissions as $permission) {
            Permission::where('name', $module . ' ' . $permission)->delete();
        }

        Artisan::call('module:migrate-reset ' . $plugin->getName(), ['--force' => true]);
        Toast::title('The plugin has been deactivated')->autoDismiss(3);
        return redirect()->back();
    }

    public function delete($plugin)
    {
        Module::findorFail($plugin)->delete();

        Toast::title('The plugin has been deleted')->autoDismiss(3);
        return redirect()->back();
    }
}
