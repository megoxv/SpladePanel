<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('getSetting')) {
    function getSetting($key)
    {
        try {
            return App\Models\Setting::where('key', $key)->value('value');
        } catch (\Exception $e) {
            return "Error: Could not connect to database.";
        }
    }
}

function social_image()
{
    return Storage::url(getSetting('social_image'));
}

function light_logo()
{
    return Storage::url(getSetting('light_logo'));
}

function dark_logo()
{
    return Storage::url(getSetting('dark_logo'));

}

function favicon()
{
    return Storage::url(getSetting('favicon'));
}
