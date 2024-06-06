<?php

namespace App\Exports;

use App\Models\Complaint;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class MonthlyExport implements FromView
{
    public $year;

    function __construct($year)
    {
        $this->year = $year;
    }

    public function view(): View
    {
        DB::statement(DB::raw('set @rownum=0'));
        $report = Complaint::select(
            '*',
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            DB::raw('MONTH(TANGGAL_INPUT) as MONTH_COMPLAINT')
        )
            ->whereYear('TANGGAL_INPUT', 2023)
            ->groupBy('MONTH_COMPLAINT')
            ->get();

        return view('complaint.admin.export.monthly-excel', [
            'report' => $report,
            'year' => $this->year
        ]);
    }
}
