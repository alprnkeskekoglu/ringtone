<?php

namespace Dawnstar\Http\Controllers;

use App\Http\Controllers\Controller;
use Dawnstar\Models\Ringtone;
use Dawnstar\Models\RingtoneTransaction;

class RingtoneTransactionController extends Controller
{

    public function index()
    {
        $transactions = RingtoneTransaction::with('user')->get();

        return view('Dawnstar::ringtone_transaction.home', compact('transactions'));
    }

    public function create()
    {
        abort(404);
    }

    public function store()
    {
        abort(404);
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $transaction = RingtoneTransaction::find($id);
        $ringtones = Ringtone::whereIn('id', json_decode($transaction->ringtones))->get();

        return view('Dawnstar::ringtone_transaction.edit', compact('transaction', 'ringtones'));
    }

    public function update($id)
    {
        //
    }

    public function delete($id)
    {
        $transaction = RingtoneTransaction::find($id);
        if ($transaction) {
            $transaction->delete();
            if ($transaction->trashed()) {
                return redirect()->route('panel.ringtone_transaction.index')->with('message', 'Delete Successful');
            }
        }
        return redirect()->back()->withErrors(['message', 'Delete Failed!'])->withInput();
    }
}
