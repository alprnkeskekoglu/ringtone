<?php

namespace App\Http\Controllers;

use Dawnstar\Models\Category;
use Dawnstar\Models\Ringtone;

class SearchController extends Controller
{
    public function index() {

        $query = request()->get('q');

        $ringtones = Ringtone::where('status', 1)
            ->orderByDesc('download_count')
            ->where(function($q) use($query) {
                $q->where('name', 'like', '%'.$query.'%')
                    ->orWhere('file', 'like', '%'.$query.'%');
            })
            ->orderByRaw("case
                when `name` like ? then 1
                when `name` like ? then 4
                when `name` like ? then 2
                when `name` like ? then 5
                when `name` like ? then 16
                when `name` like ? then 18
                when `name` like ? then 3
                when `name` like ? then 17

                when `file` like ? then 6
                when `file` like ? then 9
                when `file` like ? then 7
                when `file` like ? then 10
                when `file` like ? then 19
                when `file` like ? then 21
                when `file` like ? then 8
                when `file` like ? then 20

                else 1000 end", [
                $query . ' %',              //1
                $query . '%',               //4
                '% ' . $query . ' %',       //2
                '% ' . $query . '%',        //5
                '%' . $query . ' %',        //16
                '%' . $query . '%',         //18
                '% ' . $query . '',         //3
                '%' . $query . '',          //17

                $query . ' %',              //6
                $query . '%',               //9
                '% ' . $query . ' %',       //7
                '% ' . $query . '%',        //10
                '%' . $query . ' %',        //19
                '%' . $query . '%',         //21
                '% ' . $query . '',         //8
                '%' . $query . '',          //20

            ])->paginate(16, ["*"], 'p');

        return view('web.search', compact('ringtones'));
    }
}
