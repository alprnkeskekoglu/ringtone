<?php

namespace Dawnstar\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Dawnstar\Models\CreditTransaction;
use Dawnstar\Models\Report;
use Dawnstar\Models\RingtoneTransaction;

class ReportController extends Controller
{

    protected $labels = [];
    protected $data = [];
    protected $hold = [];
    protected $credit_labels = [];
    protected $credit_data = [];
    protected $credit_hold = [];
    protected $period;
    protected $start;
    protected $end;

    public function index()
    {

        if(request()->get('ringtone_type')) {
            $this->reportRingtone(request()->get('ringtone_type'));
        } else {
            $this->reportRingtone(1);
        }

        if(request()->get('credit_type')) {
            $this->reportCredit(request()->get('credit_type'));
        } else {
            $this->reportCredit(1);
        }

        return view('Dawnstar::report.home', [
            'ringtone_transactions' => $this->hold,
            'data' => $this->data,
            'labels' => $this->labels,
            'credit_transactions' => $this->credit_hold,
            'credit_data' => $this->credit_data,
            'credit_labels' => $this->credit_labels
        ]);
    }

    public function reportRingtone($type) {

        switch ($type) {
            case 1:
                $this->today();
                $ringtone_transactions = $this->getRingtoneTransaction("Y-m-d H");
                $format = 'H:i';
                break;
            case 2:
                $this->yesterday();
                $ringtone_transactions = $this->getRingtoneTransaction("Y-m-d H");
                $format = 'H:i';
                break;
            case 3:
                $this->lastWeek();
                $ringtone_transactions = $this->getRingtoneTransaction("Y-m-d");
                $format = 'd M';
                break;
            case 4:
                $this->lastMonth();
                $ringtone_transactions = $this->getRingtoneTransaction("Y-m-d");
                $format = 'd M';
                break;
            case 5:
                $this->lastYear();
                $ringtone_transactions = $this->getRingtoneTransaction("Y-m");
                $format = 'M Y';
                break;
            case 6:
                $this->all();
                $ringtone_transactions = $this->getRingtoneTransaction("Y-m");
                $format = 'M Y';
                break;

        }

        foreach ($ringtone_transactions as $date => $r_trans) {
            $this->hold[$date] = [
                'ringtones_count' => $r_trans->sum('ringtone_count'),
                'ringtones_amount' => $r_trans->sum('total'),
                'time' => Carbon::parse(strlen($date) == 13 ? $date. ":00:00" : $date)->format($format)
            ];
        }
        foreach ($this->period as $per) {
            $this->labels[] = $per->format($format);
            $temp = $this->hold[$per->format('Y-m-d H')] ?? ($this->hold[$per->format('Y-m-d')] ?? $this->hold[$per->format('Y-m')] ?? []);
            $this->data[] = $temp['ringtones_amount'] ?? 0;
        }
    }
    public function reportCredit($type) {

        switch ($type) {
            case 1:
                $this->today();
                $credit_transactions = $this->getCreditTransaction("Y-m-d H");
                $format = 'H:i';
                break;
            case 2:
                $this->yesterday();
                $credit_transactions = $this->getCreditTransaction("Y-m-d H");
                $format = 'H:i';
                break;
            case 3:
                $this->lastWeek();
                $credit_transactions = $this->getCreditTransaction("Y-m-d");
                $format = 'd M';
                break;
            case 4:
                $this->lastMonth();
                $credit_transactions = $this->getCreditTransaction("Y-m-d");
                $format = 'd M';
                break;
            case 5:
                $this->lastYear();
                $credit_transactions = $this->getCreditTransaction("Y-m");
                $format = 'M Y';
                break;
            case 6:
                $this->all();
                $credit_transactions = $this->getCreditTransaction("Y-m");
                $format = 'M Y';
                break;

        }

        foreach ($credit_transactions as $date => $r_trans) {
            $this->credit_hold[$date] = [
                'credits_count' => $r_trans->sum('credit'),
                'credits_amount' => $r_trans->sum('amount'),
                'time' => Carbon::parse(strlen($date) == 13 ? $date. ":00:00" : $date)->format($format)
            ];
        }
        foreach ($this->period as $per) {
            $this->credit_labels[] = $per->format($format);
            $temp = $this->credit_hold[$per->format('Y-m-d H')] ?? ($this->credit_hold[$per->format('Y-m-d')] ?? $this->credit_hold[$per->format('Y-m')] ?? []);
            $this->credit_data[] = $temp['credits_amount'] ?? 0;
        }


    }

    public function getRingtoneTransaction($format) {
        return RingtoneTransaction::where('created_at' , '>=', $this->start)
            ->orderBy('created_at')
            ->where('created_at', '<', $this->end)
            ->get()
            ->groupBy(function ($date) use($format) {
                return \Carbon\Carbon::parse($date->created_at)->format($format);
            });
    }
    public function getCreditTransaction($format) {
        return CreditTransaction::where('created_at' , '>=', $this->start)
            ->orderBy('created_at')
            ->where('created_at', '<', $this->end)
            ->get()
            ->groupBy(function ($date) use($format) {
                return \Carbon\Carbon::parse($date->created_at)->format($format);
            });
    }

    public function today() {
        $this->start = Carbon::today();
        $this->end = Carbon::tomorrow();
        $this->period = CarbonPeriod::create($this->start, "1 hour", $this->end->subHour(1));
    }
    public function yesterday() {
        $this->start = Carbon::yesterday();
        $this->end = Carbon::today();
        $this->period = CarbonPeriod::create($this->start, "1 hour", $this->end->subHour(1));
    }

    public function lastWeek() {
        $this->start = Carbon::today()->subDay(7);
        $this->end = Carbon::yesterday();
        $this->period = CarbonPeriod::create($this->start, "1 day", $this->end);
    }
    public function lastMonth() {
        $this->start = Carbon::today()->subDay(30);
        $this->end = Carbon::tomorrow()->addDay(1);
        $this->period = CarbonPeriod::create($this->start, "1 day", $this->end);
    }
    public function lastYear() {
        $this->start = Carbon::today()->subYear(1);
        $this->end = Carbon::tomorrow();
        $this->period = CarbonPeriod::create($this->start, "1 month", $this->end);
    }
    public function all() {
        $this->start = Carbon::parse('2018-12-21');
        $this->end = Carbon::now()->addMonth(1);
        $this->period = CarbonPeriod::create($this->start, "1 month", $this->end);
    }



}
