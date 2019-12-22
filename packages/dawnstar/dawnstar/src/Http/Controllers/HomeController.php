<?php

namespace Dawnstar\Http\Controllers;

use App\Http\Controllers\Controller;
use Dawnstar\Models\Answer;

class HomeController extends Controller
{

    public function index()
    {
        return view('Dawnstar::home');
    }
}
