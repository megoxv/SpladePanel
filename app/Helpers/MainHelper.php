<?php

namespace App\Helpers;

use App\Models\MenuLink;
use App\Models\RateLimit;
use App\Models\RateLimitDetail;
use App\Models\ReportError;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;

class MainHelper
{
    public static function make_error_report(
        $options = []
    ) {
        $options = array_merge([
            'error' => "",
            'error_code' => "",
            'details' => json_encode(request()->instance())
        ], $options);
        try {
            if (Schema::hasTable('report_errors'))
                ReportError::create([
                    'user_id' => (auth()->check() ? auth()->user()->id : null),
                    'title' => $options['error'],
                    'code' => $options['error_code'],
                    'url' => url()->previous(),
                    'ip' => UserSystemInfoHelper::get_ip(),
                    'user_agent' => request()->header('User-Agent'),
                    'request' => json_encode(request()->all()),
                    'description' => $options['details']
                ]);
        } catch (\Exception $e) {
        }
    }

    public static function rate_limit_insert()
    {

        $ip = UserSystemInfoHelper::get_ip();


        $last_insert = \App\Models\RateLimit::where('ip', $ip)->where('created_at', '<=', Carbon::parse(now())->addMinutes(3))->first();

        if ($last_insert == null) {
            $prev_url = "";
            $prev_domain = "";
            if (filter_var(url()->previous(), FILTER_VALIDATE_URL)) // is a valid url 
            {
                $parsex = parse_url(url()->previous());
                $prev_domain = $parsex['host'];
                $prev_domain = "";
                try {
                    $prev_url = url()->previous();
                    $prev_domain = $parsex['host'];
                } catch (\Exception $e) {
                }
            }
            $country = (new UserSystemInfoHelper)->get_country_from_ip($ip);
            $traffic = RateLimit::create([
                'traffic_landing' => Request::fullUrl(),
                'domain' => $prev_domain,
                'prev_link' => $prev_url,
                'ip' => $ip,
                //'country_code'=>$country['country_code'],
                //'country_name'=>$country['country'],
                'agent_name' => request()->header('User-Agent'),
                'user_id' => auth()->check() ? auth()->user()->id : null,
                'browser' => UserSystemInfoHelper::get_browsers(),
                'device' => UserSystemInfoHelper::get_device(),
                'operating_system' => UserSystemInfoHelper::get_os()
            ]);
            RateLimitDetail::create([
                'url' => request()->fullUrl(),
                'user_id' => auth()->check() ? auth()->user()->id : null,
                'rate_limit_id' => $traffic->id,
                'ip' => $ip
            ]);
            return $traffic;
        } else {
            RateLimitDetail::create([
                'url' => request()->fullUrl(),
                'user_id' => auth()->check() ? auth()->user()->id : null,
                'rate_limit_id' => $last_insert->id,
                'ip' => $ip
            ]);
        }
        return $last_insert;
    }
}
