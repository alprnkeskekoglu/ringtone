<?php

namespace App\Http\Controllers;

use Dawnstar\Models\Category;
use Dawnstar\Models\Ringtone;
use Illuminate\Support\Facades\Request;

class RingtoneController extends Controller
{
    public function index() {

        $categories = \Dawnstar\Models\Category::whereNull('parent_id')
            ->where('status', 1)
            ->with('children')
            ->get();


        $ringtones = Ringtone::where('status', 1)
            ->paginate(16);

        return view('web.ringtone.index', compact('categories', 'ringtones'));
    }

    public function filter() {
        $category_id = request()->get('category_id');
        $type = request()->get('type');
        $order = request()->get('order');

        $ringtones = Ringtone::where('status', 1);

        if(! is_null($category_id)) {
            $ringtones = $ringtones->where('category_id', $category_id);
        }
        if(! is_null($type)) {
            $ringtones = $ringtones->where('type', $type);
        }

        if($order == 'download_k-b') {
            $ringtones = $ringtones->orderBy('download_count');
        } elseif($order == 'download_b-k') {
            $ringtones = $ringtones->orderByDesc('download_count');
        } elseif($order == 'credit_k-b') {
            $ringtones = $ringtones->orderBy('credit');
        } elseif($order == 'credit_b-k') {
            $ringtones = $ringtones->orderByDesc('credit');
        } else {
            $ringtones = $ringtones->orderByDesc('created_at');
        }

        $ringtones = $ringtones->paginate(16);

        return view('web.ringtone.ajax', compact('ringtones'))->render();
    }

    public function download() {
        $ringtone_id = request()->get('ringtone_id');

        $rintone = Ringtone::find($ringtone_id);

        $rintone->download_count ++;
        $rintone->save();
    }

}
