<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $complain = Complaint::select('*')
            ->whereMonth('TANGGAL_INPUT', $request->daily_month)
            ->whereYear('TANGGAL_INPUT', $request->daily_year)
            ->get();
        $data = ['report' => $complain];
        return Pdf::loadView('complaint.admin.export.cetak_pdf', $data)->stream();
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
