<?php

namespace App\Http\Controllers;

use Dawnstar\Models\Category;
use Dawnstar\Models\Ringtone;

class HomeController extends Controller
{
    public function index() {

        $newest = Ringtone::where('status', 1)
            ->orderByDesc('created_at')
            ->get()
            ->take(12);


        $popularities = Ringtone::where('status', 1)
            ->orderByDesc('download_count')
            ->get()
            ->take(12);

        $prices = Ringtone::where('status', 1)
            ->orderByDesc('credit')
            ->get()
            ->take(12);


        return view('web.home', compact('newest', 'popularities', 'prices'));
    }
}
