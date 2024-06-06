<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complaint;
use App\Exports\DailyExport;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


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




        $complain =  Complaint::select('*',  )
        ->whereMonth('TANGGAL_INPUT', $request->daily_month)
        ->whereYear('TANGGAL_INPUT', $request->daily_year)
        ->get();
        $data = ['report' => $complain ];
        // return view('complaint.admin.export.daily-excel',$data);
        // $pdf = Pdf::loadView('complaint.admin.export.pdf', $data );

         return Pdf::loadView('complaint.admin.export.daily-excel', $data )->stream();

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
            'daily_month' => 'required',
            'daily_year' => 'required',
        ];
        $messages = [
            'daily_month.required_if' => 'Bulan harus diisi untuk laporan harian',
            'daily_year.required_if' => 'Tahun harus diisi untuk laporan harian',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
