<?php

namespace App\Exports;

use App\Models\Complaint;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AnnualExport implements FromView
{
    public $year_start;
    public $year_end;

    function __construct($year_start, $year_end)
    {
        $this->year_start = $year_start;
        $this->year_end = $year_end;
    }

    public function view(): View
    {
        DB::statement(DB::raw('set @rownum=0'));
        $report = Complaint::select(
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            DB::raw('YEAR(TANGGAL_PENGADUAN) as YEAR_COMPLAINT'),
        )
            ->whereRaw('YEAR(TANGGAL_PENGADUAN) BETWEEN ' . $this->year_start . ' AND ' . $this->year_end)
            ->groupBy('YEAR_COMPLAINT')
            ->orderBy('YEAR_COMPLAINT', 'asc')
            ->get();

        return view('complaint.admin.export.annual-excel', [
            'report' => $report,
            'year_start' => $this->year_start,
            'year_end' => $this->year_end
        ]);
    }
}
