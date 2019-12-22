<?php

namespace Dawnstar\Http\Controllers;

use App\Http\Controllers\Controller;
use Dawnstar\Models\Report;

class ReportController extends Controller
{

    public function index()
    {
        $reports = Report::all();

        return view('Dawnstar::report.home', compact('reports'));
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $report = Report::find($id);

        if($report->read_status !=  1) {
            $report->read_status = 1;
            $report->save();
        }

        return view('Dawnstar::report.edit', compact('report', 'questions'));
    }

    public function update($id)
    {
        $report = Report::find($id);
        $data = request()->all();
        unset($data['_token']);

        $report->update($data);

        if ($report->wasChanged()) {
            return redirect()->back()->with('message', 'The update was done successfully.');
        }
        return redirect()->back()->withErrors(['message', 'Update failed.'])->withInput();
    }

    public function delete($id)
    {
        $report = Report::find($id);
        if ($report) {
            $report->delete();
            if ($report->trashed()) {
                return redirect()->route('panel.report.index')->with('message', 'Delete Successful');
            }
        }
        return redirect()->back()->withErrors(['message', 'Delete Failed!'])->withInput();
    }
}
