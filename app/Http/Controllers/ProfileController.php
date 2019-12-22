<?php

namespace App\Http\Controllers;

use Dawnstar\Models\Category;
use Dawnstar\Models\Ringtone;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $ringtones = auth()->user()->ringtones()->paginate(16);


        $categories = \Dawnstar\Models\Category::whereNull('parent_id')
            ->where('status', 1)
            ->with('children')
            ->get();

        return view('web.profile.index', compact('ringtones', 'categories'));
    }


    public function filter() {
        $category_id = request()->get('category_id');
        $type = request()->get('type');
        $order = request()->get('order');

        $ringtones = auth()->user()->ringtones();

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

        return view('web.profile.ajax', compact('ringtones'))->render();
    }
}
