<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ComplaintExport;
use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\News;
use App\Models\Petugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class ComplaintController extends Controller
{
    public function indexInbox(Request $request)
    {

        $this->authorize('admin');

        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $complaint = Complaint::select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'UUID', 'KODE_PENGADUAN', 'NAMA_TERLAPOR', 'TANGGAL_PENGADUAN', 'LOKASI', 'PRIORITAS', 'URAIAN', 'PELAKSANA','TANGGAL_INPUT','KONDISI_IGD','KETERANGAN_SHIFT', 'CREATED_AT'])
                ->where('STATUS', 1)
                ->orderBy('CREATED_AT', 'desc');

            return DataTables::of($complaint)
                // ->addColumn('violation', function ($item) {
                //     return $item->violation->NAMA;
                // })
                ->addColumn('date', function ($item) {
                    return Carbon::parse($item->CREATED_AT)->isoFormat('D MMMM Y');
                })
                ->addColumn('action', function ($item) {
                    $encrypt = Crypt::encryptString($item->UUID);
                    return '<a href="' . route('admin.complaint.inbox.show', $encrypt) . '" class="btn btn-primary">Detail</a>';
                })
                ->addColumn('PRIORITAS', function ($prioritas) {
                    if ($prioritas->PRIORITAS == 1) {
                        return '<rounded-pill bg-info text-white">Pagi</span>';
                    } elseif ($prioritas->PRIORITAS == 2) {
                        return '<span class="rounded-pill bg-info text-white">Siang</span>';
                    }
                })
                ->rawColumns(['action', 'status', 'PRIORITAS'])->make();
        }
        return view('complaint.admin.index');
    }


    public function show_superadmin($id)
    {
        $decrypt = Crypt::decryptString($id);

        $complaint = Complaint::where('UUID', $decrypt)->firstOrFail();
        $complaint->TANGGAL_KEJADIAN = Carbon::parse($complaint->TANGGAL_KEJADIAN)->isoFormat('D MMMM Y : H:m:s');
        $complaint->TANGGAL_PENGADUAN = Carbon::parse($complaint->TANGGAL_PENGADUAN)->isoFormat('D MMMM Y : H:m:s');

        $data = ['complaint' => $complaint, 'id' => $id];
        return view('complaint.admin.showadmin', $data);
    }


    public function petugas($id)
    {
        $decrypt = Crypt::decryptString($id);

        $complaint = Complaint::where('UUID', $decrypt)->firstOrFail();
        $petugas = Petugas::all();

        $data = [
            'complaint' => $complaint, 'id' => $id,
            'petugas' => $petugas,
        ];
        return view('complaint.admin.petugas', $data);
    }

    public function create_note(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $decrypt = Crypt::decryptString($id);

            Complaint::where('UUID', $decrypt)->update([
                'NOTES' => $request->notes
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Sukses'
            ]);
        }
    }
}
