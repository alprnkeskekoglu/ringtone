<?php

namespace Dawnstar\Http\Controllers;

use App\Http\Controllers\Controller;
use Dawnstar\Models\CreditTransaction;

class CreditTransactionController extends Controller
{

    public function index()
    {
        $transactions = CreditTransaction::with('user')->get();

        return view('Dawnstar::credit_transaction.home', compact('transactions'));
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
        $transaction = CreditTransaction::find($id);

        return view('Dawnstar::credit_transaction.edit', compact('transaction'));
    }

    public function update($id)
    {
        //
    }

    public function delete($id)
    {
        $transaction = CreditTransaction::find($id);
        if ($transaction) {
            $transaction->delete();
            if ($transaction->trashed()) {
                return redirect()->route('panel.credit_transaction.index')->with('message', 'Delete Successful');
            }
        }
        return redirect()->back()->withErrors(['message', 'Delete Failed!'])->withInput();
    }
}
