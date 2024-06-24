<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\News;
use App\Models\Petugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class ComplaintController extends Controller
{
    public function indexInbox(Request $request)
    {
        $this->authorize('admin');

        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $complaint = Complaint::select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'UUID', 'KODE_PENGADUAN', 'TANGGAL_INPUT', 'TANGGAL_PENGADUAN', 'KETERANGAN_SHIFT', 'KONDISI_IGD', 'NAMA_PETUGAS', 'IDENTITAS', 'PELAKSANA', 'CREATED_AT'])
                ->where('STATUS', 1)
                ->orderBy('TANGGAL_INPUT', 'desc');

            return DataTables::of($complaint)
                ->addColumn('date', function ($item) {
                    return Carbon::parse($item->CREATED_AT)->isoFormat('D MMMM Y');
                })
                ->addColumn('action', function ($item) {
                    $encrypt = Crypt::encryptString($item->UUID);
                    return '<a href="' . route('admin.complaint.inbox.show', $encrypt) . '" class="btn btn-primary btn-sm image-view">Lihat</a>';
                })

                ->addColumn('delete', function ($item) {
                    $encrypt = Crypt::encryptString($item->UUID);
                    return '<a href="' . route('admin.complaint.delete', $encrypt) . '" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</a>';
                })

                ->addColumn('edit', function ($item) {
                    $encrypt = Crypt::encryptString($item->UUID);
                    return '<a href="' . route('admin.complaint.edit', $encrypt) . '" class="btn btn-outline-success ">Revisi</a>';
                })

                ->addColumn('KETERANGAN_SHIFT', function ($complaint) {
                    return $complaint->KETERANGAN_SHIFT;
                })
                ->rawColumns(['action', 'edit', 'delete', 'status', 'KETERANGAN_SHIFT'])
                ->make();
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

    // public function edit_complaint($id)
    // {
    //     $decrypt = Crypt::decryptString($id);
    //     $complaint = Complaint::where('UUID', $decrypt)->firstOrFail();
    //     $complaint->TANGGAL_KEJADIAN = Carbon::parse($complaint->TANGGAL_KEJADIAN)->isoFormat('D MMMM Y : H:m:s');
    //     $complaint->TANGGAL_PENGADUAN = Carbon::parse($complaint->TANGGAL_PENGADUAN)->isoFormat('D MMMM Y : H:m:s');

    //     $complaintTicket = 'SIMRS' . date('Ymd') . round(microtime(true) * 1000);

    //     $data = [

    //         'complaint' => $complaint, 'id' => $id,
    //         'complaintTicket' => $complaintTicket,
    //     ];
    //     return view('complaint.admin.edit_complaint', $data);
    // }

    public function edit_complaint($id)
    {
        $decrypt = Crypt::decryptString($id);
        $complaint = Complaint::where('UUID', $decrypt)->firstOrFail();

        $data = ['complaint' => $complaint, 'id' => $id];
        return view('complaint.admin.editadmin', $data);
    }
    public function update_complaint(Request $request, $id)
{
    $decrypt = Crypt::decryptString($id);

    $complaint = Complaint::where('UUID', $decrypt)->firstOrFail();

    $complaint->update($request->all());

    return redirect()->back()->withSuccess('sudah diupdate');
}


    // public function update_complaint(Request $request, $id)
    // {

    //     $decrypt = Crypt::decryptString($id);

    //     $complaint = Complaint::where('UUID', $decrypt)->firstOrFail();

    //     // Validasi input
    //     $request->validate([
    //         'TANGGAL_INPUT' => 'required|date',

    //         'KONDISI_IGD' => 'required|string|max:255',

    //         'KETERANGAN_SHIFT' => 'required|string|max:255',
    //         'NAMA_PETUGAS' => 'required|string|max:255',
    //         'IDENTITAS' => 'required|string|max:255',
    //         // Tambahkan validasi lain sesuai kebutuhan
    //     ]);

    //     $complaint->TANGGAL_INPUT = $request->input('TANGGAL_INPUT');
    //     $complaint->KETERANGAN_SHIFT = $request->input('KETERANGAN_SHIFT');
    //     $complaint->NAMA_PETUGAS = $request->input('NAMA_PETUGAS');
    //     $complaint->IDENTITAS = $request->input('IDENTITAS');
    //     $complaint->KONDISI_IGD = $request->input('KONDISI_IGD');

    //     $complaint->save();
    //     return redirect()->route('admin.complaint.edit', $id)->with('success', 'Data berhasil diupdate.');
    // }



    public function delete_complaint($id)
    {
        $decrypt = Crypt::decryptString($id);

        Complaint::where('UUID', $decrypt)->delete();

        // Redirect ke halaman view, ganti 'admin.complaint.inbox' dengan nama route yang sesuai
        return redirect()->route('admin.complaint.inbox')->with('success', 'Complaint deleted successfully.');
    }




    public function create()
    {
        $complaintTicket = 'SIMRS' . date('Ymd') . round(microtime(true) * 1000);

        $data = [
            'complaintTicket' => $complaintTicket,
        ];
        return view('complaint.user.create', $data);
    }


    public function store_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $decrypt = Crypt::decryptString($id);

            if ($request->hasFile('file_selesai')) {
                $data['FILE_SELESAI'] = $request->file_selesai = $request->file('file_selesai')->storeAs('uploads', 'Work_' . $request->complaint_ticket . '.' . $request->file_selesai->extension());
            }

            Complaint::where('UUID', $decrypt)->update([
                'WAKTU_SELESAI' => date('Y-m-d H:i:s'),
                'IS_MULAI' => 2,
                'PELAKSANA' => $request->petugas,
                'STATUS' => 4,
                'FILE_SELESAI' => $request->file_selesai,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Sukses',
            ]);
        }
    }
}
