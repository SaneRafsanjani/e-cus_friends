<?php

namespace App\Exports;

use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class DailyExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $month;
    public $year;

    function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {
        $format = Carbon::createFromDate($this->year, $this->month, null, null)->locale('id');
        DB::statement(DB::raw('set @rownum=0'));
        $report = Complaint::select(
            '*',
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            DB::raw('MONTH(TANGGAL_INPUT) as MONTH_COMPLAINT')
        )
            ->whereMonth('TANGGAL_INPUT', $this->month)
            ->whereYear('TANGGAL_INPUT', $this->year)
            ->get();

        return view('complaint.admin.export.daily-excel', [
            'report' => $report,
            'month' => $format->isoformat('MMMM'),
            'year'  => $format->format('Y')
        ]);
    }
}

