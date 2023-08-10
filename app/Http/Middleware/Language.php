<?php

namespace App\Http\Middleware;

use App\Models\Language as ModelsLanguage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } else {
            // Get the user's preferred language from the database
            $language = ModelsLanguage::where('code', $request->segment(1))->first();
            $locale = $language ? $language->code : config('app.locale');
            Session::put('locale', $locale);
        }

        App::setLocale($locale);
        return $next($request);
    }
}
