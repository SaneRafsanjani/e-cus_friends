<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnnualExport;
use App\Exports\DailyExport;
use App\Exports\MonthlyExport;
use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        return view('complaint.admin.report');
    }

    public function report(Request $request)
    {
        $validation = $this->validation($request);
        if ($validation->fails()) {
            return redirect()->route('admin.complaint.report')->withErrors($validation)->withInput();
        }
        return Excel::download(new DailyExport($request->daily_month, $request->daily_year), 'Laporan-Harian.xlsx');
    }

    public function report_pdf(Request $request)
    {
        $complaint = Complaint::all();

        $pdf = PDF::loadview('complaint.admin.export.pdf',['complaint' => $complaint]);
        return $pdf->download('');
    }

    public function validation(Request $request)
    {
        $rules = [
            'daily_month' => 'required_if:type,1',
            'daily_year' => 'required_if:type,1',
            'monthly_year' => 'required_if:type,2',
            'annual_year_start' => 'required_if:type,3',
            'annual_year_end' => 'required_if:type,3',
        ];
        $messages = [
            'daily_month.required_if' => 'Bulan harus diisi untuk laporan harian',
            'daily_year.required_if' => 'Tahun harus diisi untuk laporan harian',
            'monthly_year.required_if' => 'Tahun harus diisi untuk laporan bulanan',
            'annual_year_start.required_if' => 'Tahun awal harus diisi untuk laporan tahunan',
            'annual_year_end.required_if' => 'Tahun akhir harus diisi untuk laporan tahunan',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
