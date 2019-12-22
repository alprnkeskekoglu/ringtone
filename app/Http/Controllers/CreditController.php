<?php

namespace App\Http\Controllers;

use Dawnstar\Models\Category;
use Dawnstar\Models\CreditTransaction;
use Dawnstar\Models\Ringtone;

class CreditController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        return view('web.credit');
    }

    public function credit() {
        $credit = request()->get('credit');
        $user = auth()->user();


        CreditTransaction::firstOrCreate([
            'user_id' => $user->id,
            'credit' => $credit,
            'amount' => (double) number_format($credit - ($credit/10), 2)
        ]);

        $user->credit += $credit;
        $user->save();

    }

}
