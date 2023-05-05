<?php

namespace App\Http\Controllers\analytic;

use App\Charts\gender_chart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function dashboard_analytics()
    {
            $gender_chart = new gender_chart;
            $gender_chart->labels(['June', 'July', 'August']);
            $gender_chart->dataset('gender', 'pie', [400, 392, 355]);


        return view('admin.dashboard.analytics.analytics', compact('gender_chart'));
    }
}
