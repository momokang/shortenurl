<?php

namespace App\Http\Controllers;

use App\Models\Analytic;
use App\Models\Url;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $urls = Url::orderBy('id', 'desc')->paginate(50);

        return view('dashboard.index', compact('urls'));
    }

    public function analytic($hashId)
    {
        $url = Url::where('hashid', $hashId)->first();

        $days30ago = Carbon::today()->subMonth();
        $analytics = Analytic::where('url_id', $url->id)
            ->where('date', '>=', $days30ago)
            ->orderBy('id', 'desc')
            ->pluck('impression', 'date')
            ->toArray();

        $data = [];
        while ($days30ago <= Carbon::today()) {
            $day = $days30ago->toDateString();
            if (isset($analytics[$day])) {
                $data[$days30ago->format('d M')] = $analytics[$day];
            } else {
                $data[$days30ago->format('d M')] = 0;
            }
            $days30ago->addDay();
        }

        return view('dashboard.analytic', compact('url', 'data'));
    }
}
