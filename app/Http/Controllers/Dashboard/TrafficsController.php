<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ReportError;
use App\Tables\ErrorReports;
use App\Tables\Traffics;
use App\Tables\TrafficsLogs;
use Illuminate\Http\Request;

class TrafficsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read reports',   ['only' => ['index', 'logs', 'error_reports', 'error_report']]);
    }

    public function index()
    {
        return view('dashboard.traffics.index', [
            'traffics' => Traffics::class,
        ]);
    }

    public function logs()
    {
        return view('dashboard.traffics.logs', [
            'logs' => TrafficsLogs::class
        ]);
    }

    public function error_reports()
    {
        return view('dashboard.traffics.error-reports', [
            'reports' => ErrorReports::class
        ]);
    }

    public function error_report(ReportError $report)
    {
        return dd($report);
    }
}
