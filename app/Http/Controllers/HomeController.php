<?php

namespace App\Http\Controllers;

use App\Models\Analytic;
use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelHashids\Facades\Hashids;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->merge(['url' => $request->get('url_prefix') . $request->get('url')]);
            $request->validate([
                'url' => 'required|url',
            ]);

            if (!auth()->check()) {
                return redirect()->route('home')->with('error', 'Please login before shorten url.');
            }

            $url = $request->get('url');
            if ($link = Url::where('url', $url)->first()) {
                return redirect()->route('hash', $link->hashid)->with('error', 'This url had been shortened previously.');
            }

            $nextId = Url::select('id')->orderBy('id', 'desc')->value('id') + 1;
            $hashid = Hashids::encode($nextId);

            $link = Url::create([
                'url' => $url,
                'hashid' => $hashid,
                'created_by_id' => auth()->id(),
            ]);

            return redirect()->route('hash', $link->hashid);
        }

        return view('home.index');
    }

    public function hash($hashId)
    {
        $url = Url::where('hashid', $hashId)->first();
        return view('home.hash', compact('url'));
    }

    public function url($hashId)
    {
        $url = Url::where('hashid', $hashId)->first();
        if (!$url) abort(404, 'Cant find');

        $url->increment('impression');

        $analytic = Analytic::where('url_id', $url->id)
            ->where('date', Carbon::today())
            ->first();

        if ($analytic) {
            $analytic->increment('impression');
        } else {
            Analytic::create([
                'date' =>  Carbon::today(),
                'impression' =>  1,
                'url_id' =>  $url->id,
            ]);
        }

        return redirect()->away($url->url);
    }
}
