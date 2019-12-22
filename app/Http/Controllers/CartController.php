<?php

namespace App\Http\Controllers;

use Dawnstar\Models\Category;
use Dawnstar\Models\Ringtone;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $user = auth()->user();
        $ringtone_id = request()->get('ringtone_id');
        $key = $user->id . '_cart';
        $session = session()->get($key);
        $cart = $session ? json_decode(decrypt($session), 1) : [];


        if(in_array($ringtone_id, $cart)) {
            unset($cart[array_search($ringtone_id, $cart)]);
            $flag = false;
        } else {
            $cart[] = $ringtone_id;
            $flag = true;
        }

        $cart_ringtones = $this->getRingtones($cart);

        $cart = encrypt(json_encode($cart));
        session()->put($key, $cart);


        $view = view('web.layouts.cart', compact('cart_ringtones'))->render();
        return response()->json(['status' => $flag, 'view' => $view], 200);
    }

    protected function getRingtones($ids) {

        return Ringtone::whereIn('id', $ids)
            ->get();
    }
}
