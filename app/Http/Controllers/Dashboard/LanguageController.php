<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Tables\Languages;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create languages', ['only' => ['create', 'store']]);
        $this->middleware('can:read languages',   ['only' => ['show', 'index']]);
        $this->middleware('can:update languages',   ['only' => ['edit', 'update']]);
        $this->middleware('can:delete languages',   ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.languages.index', [
            'languages' => Languages::class,
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
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'dir' => 'required',
            'icon' => 'required',
            'status' => 'required',
        ]);

        $code = trim(strtolower(substr($request->code, 0, 2)));

        $success = false;
        $language = Language::where("code", $code)->first();
        if (empty($language)) {
            // Generate Lang files
            if ($code == "en") {
                $success = true;
            } else {
                $success = \File::copyDirectory(base_path("lang/en"), base_path("lang/$code"));
            }

            if ($success) {
                $language = new Language;
                $language->name = $request->name;
                $language->code = trim(strtolower($request->code));
                $language->dir = $request->dir;
                $language->icon = trim(strtolower($request->icon));
                $language->status = $request->status;
                $language->save();

                Toast::title(__('main.language_created'))->autoDismiss(3);
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'dir' => 'required',
            'icon' => 'required',
            'status' => 'required',
        ]);

        $language->update([
            'name' => $request->name,
            'code' => trim(strtolower($request->code)),
            'dir' => $request->dir,
            'icon' => trim(strtolower($request->icon)),
            'status' => $request->status,
        ]);

        Toast::title(__('main.language_updated'))->autoDismiss(3);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        // dd($language->code);
        if ($language->code != getSetting('website_language')) {
            if ($language->code == "en") {
                $success = true;
            } else {
                $success = \File::deleteDirectory(base_path("lang/" . $language->code));
            }

            if ($success) {
                $language->delete();
                Toast::title(__('main.language_deleted'))->autoDismiss(3);
                return redirect()->back();
            }
        }

        Toast::warning(__('main.you_cannot_delete_this_default_language'))->autoDismiss(3);
        return redirect()->back();
    }
}
