<?php

namespace App\Http\Controllers;

use Dawnstar\Models\Category;
use Dawnstar\Models\CreditTransaction;
use Dawnstar\Models\Ringtone;
use Illuminate\Http\Request;

class CreditController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        return view('web.credit');
    }

    public function credit(Request $request) {
        $credit = $request->get('credit');
        $user = auth()->user();


        CreditTransaction::firstOrCreate([
            'user_id' => $user->id,
            'credit' => $credit,
            'amount' => (double) number_format($credit - ($credit/10), 2)
        ]);

        $user->credit += $credit;
        $user->save();

        return response()->json(['status' => true]);
    }

}
