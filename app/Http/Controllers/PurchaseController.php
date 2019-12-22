<?php

namespace App\Http\Controllers;

use Dawnstar\Models\Category;
use Dawnstar\Models\Ringtone;
use Dawnstar\Models\RingtoneTransaction;

class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $user = auth()->user();
        $key = $user->id . '_cart';
        $session = session()->get($key);
        $cart = $session ? json_decode(decrypt($session), 1) : [];

        $ringtones = Ringtone::whereIn('id', $cart)
            ->get();

        return view('web.purchase', compact('ringtones'));
    }

    public function purchase() {
        $user = auth()->user();
        $key = $user->id . '_cart';
        $session = session()->get($key);
        $cart = $session ? json_decode(decrypt($session), 1) : [];

        $ringtones = Ringtone::whereIn('id', $cart)
            ->get();
        $total = $ringtones->sum('credit');

        if($user->credit >= $total) {
            $user->credit -= $total;
            $user->save();


            $user->ringtones()->attach($cart);

            RingtoneTransaction::firstOrCreate([
                'user_id' => $user->id,
                'total' => $total,
                'ringtones' => json_encode($cart)
            ]);

            session()->forget($key);

            return response()->json(['status' => true], 200);
        } else {
            return response()->json(['status' => false], 200);
        }
    }

}
