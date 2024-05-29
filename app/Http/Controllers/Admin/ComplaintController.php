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
            $complaint = Complaint::select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'UUID', 'KODE_PENGADUAN', 'NAMA_TERLAPOR', 'TANGGAL_PENGADUAN', 'LOKASI', 'PRIORITAS', 'URAIAN', 'PELAKSANA', 'CREATED_AT'])
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
                        return '<span class="badge rounded-pill badge-info">Tidak Darurat</span>';
                    } elseif ($prioritas->PRIORITAS == 2) {
                        return '<span class="badge rounded-pill badge-danger">Darurat</span>';
                    }
                })
                ->rawColumns(['action', 'status', 'PRIORITAS'])->make();
        }
        return view('complaint.admin.index');
    }

    public function indexFollowup(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->get('status');

            $prioritas = $request->get('prioritas');

            DB::statement(DB::raw('set @rownum=0'));
            $complaint = Complaint::select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'UUID', 'KODE_PENGADUAN', 'NAMA_TERLAPOR', 'TANGGAL_PENGADUAN', 'LOKASI', 'STATUS', 'PRIORITAS', 'URAIAN', 'CREATED_AT'])
                ->when($status, function ($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->when($prioritas, function ($query) use ($prioritas) {
                    return $query->where('prioritas', $prioritas);
                })
                ->where('STATUS', '!=', 1)
                ->orderBy('CREATED_AT', 'desc');

            return DataTables::of($complaint)
                // ->addColumn('violation', function ($item) {
                //     return $item->violation->NAMA;
                // })
                ->addColumn('STATUS', function ($status) {
                    if ($status->STATUS == 2) {
                        return '<span class="badge rounded-pill badge-info">Mulai</span>';
                    } elseif ($status->STATUS == 3) {
                        return '<span class="badge rounded-pill badge-warning text-dark">Proses</span>';
                    } elseif ($status->STATUS == 4) {
                        return '<span class="badge rounded-pill badge-success">Selesai</span>';
                    }
                })
                ->addColumn('PRIORITAS', function ($prioritas) {
                    if ($prioritas->PRIORITAS == 1) {
                        return '<span class="badge rounded-pill badge-info">Tidak Darurat</span>';
                    } elseif ($prioritas->PRIORITAS == 2) {
                        return '<span class="badge rounded-pill badge-danger">Darurat</span>';
                    }
                })
                ->addColumn('date', function ($item) {
                    return Carbon::parse($item->CREATED_AT)->isoFormat('D MMMM Y');
                })
                ->addColumn('action', function ($item) {
                    $encrypt = Crypt::encryptString($item->UUID);
                    return '<a href="' . route('admin.complaint.followup.show', $encrypt) . '" class="btn btn-primary">Detail</a>';
                })
                ->rawColumns(['action', 'STATUS', 'PRIORITAS'])->make();
        }
        return view('complaint.admin.index-followup');
    }

    public function show($id)
    {
        $decrypt = Crypt::decryptString($id);

        // $news = News::where('ID_PENGADUAN', $decrypt)->first();
        $complaint = Complaint::where('UUID', $decrypt)->firstOrFail();
        $TANGGAL_KEJADIAN = Carbon::parse($complaint->TANGGAL_KEJADIAN)->isoFormat('H:m:s');
        $WAKTU_DIPROSES = Carbon::parse($complaint->WAKTU_DIPROSES)->isoFormat('H:m:s');
        $complaint->SELISIH = Carbon::parse($TANGGAL_KEJADIAN)->diffInMinutes($WAKTU_DIPROSES);
        // $complaint->TANGGAL_KEJADIAN = Carbon::parse($complaint->TANGGAL_KEJADIAN)->locale('id')->isoFormat('D MMMM Y , H:m');
        // $complaint->TANGGAL_PENGADUAN = Carbon::parse($complaint->TANGGAL_PENGADUAN)->locale('id')->isoFormat('D MMMM Y');



        $data = ['complaint' => $complaint, 'id' => $id];
        return view('complaint.admin.show', $data);
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
                'FILE_SELESAI' => $request->file_selesai
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Sukses'
            ]);
        }
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

    public function createNews($id)
    {
        $data = ['id' => $id];
        return view('complaint.admin.news', $data);
    }

    public function storeNews(Request $request)
    {
        if ($request->ajax()) {
            $validation = Validator::make(
                $request->all(),
                [
                    'id' => 'required',
                    'date' => 'required',
                    'place' => 'required',
                    'name' => 'required',
                    'discussion' => 'required'
                ],
                [
                    'id.required' => 'ID harus diisi',
                    'date.required' => 'Tanggal harus diisi',
                    'place.required' => 'Tempat acara harus diisi',
                    'name.required' => 'Pimpinan rapat harus diisi',
                    'discussion.required' => 'Pembahasan harus diisi'
                ]
            );

            if ($validation->fails()) {
                return response()->json([
                    'code' => 400,
                    'message' => $validation->messages(),
                ]);
            } else {
                $news = News::create([
                    'ID_PENGADUAN' => Crypt::decryptString($request->id),
                    'TANGGAL' => $request->date,
                    'TEMPAT' => $request->place,
                    'PIMPINAN_RAPAT' => $request->name,
                    'PEMBAHASAN' => $request->discussion
                ]);
                $news->save();

                return response()->json([
                    'code' => 200,
                    'id' => $request->id,
                    'message' => 'Sukses',
                ]);
            }
        }
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $decrypt = Crypt::decryptString($id);
            $status = $request->get('status');

            if ($status === 1) {
                $message = 'Diproses';
            } else if ($status === 2) {
                $message = 'Diproses';
            } else {
                $message = 'Diterima';
            }

            Complaint::where('UUID', $decrypt)->update([
                'STATUS' => $status,
                'KETERANGAN' => $message,
                'WAKTU_DIPROSES' => date('Y-m-d H:i:s')
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Sukses'
            ]);
        }
    }

    public function start_tugas(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $decrypt = Crypt::decryptString($id);

            Complaint::where('UUID', $decrypt)->update([
                'WAKTU_MULAI' => date('Y-m-d H:i:s'),
                'IS_MULAI' => 1,
                'STATUS' => 3
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Sukses'
            ]);
        }
    }

    public function end_tugas(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $decrypt = Crypt::decryptString($id);

            Complaint::where('UUID', $decrypt)->update([
                'WAKTU_SELESAI' => date('Y-m-d H:i:s'),
                'IS_MULAI' => 2,
                'STATUS' => 4
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Sukses'
            ]);
        }
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

    public function print($id)
    {
        $decrypt = Crypt::decryptString($id);

        $complaint = Complaint::where('UUID', $decrypt)->first();
        $complaint->TANGGAL_KEJADIAN = Carbon::parse($complaint->TANGGAL_KEJADIAN)->locale('id')->isoFormat('D MMMM Y');
        $complaint->TANGGAL_PENGADUAN = Carbon::parse($complaint->TANGGAL_PENGADUAN)->locale('id')->isoFormat('D MMMM Y');

        $data = ['complaint' => $complaint];
        return view('complaint.admin.export.print', $data);
    }

    public function evidenceDownload($id)
    {
        $decrypt = Crypt::decryptString($id);
        $complaint = Complaint::where('UUID', $decrypt)->first();

        if (Storage::exists($complaint->FILE)) {
            return Storage::download($complaint->FILE);
        } else {
            return abort(404);
        }
    }

    public function newsDownload($id)
    {
        $decrypt = Crypt::decryptString($id);

        $complaint = Complaint::where('UUID', $decrypt)->first();
        $complaint->TANGGAL_KEJADIAN = Carbon::parse($complaint->TANGGAL_KEJADIAN)->locale('id')->isoFormat('D MMMM Y');
        $complaint->TANGGAL_PENGADUAN = Carbon::parse($complaint->TANGGAL_PENGADUAN)->locale('id')->isoFormat('D MMMM Y');
        $news = News::where('ID_PENGADUAN', $decrypt)->first();
        $news->TANGGAL = Carbon::parse($news->TANGGAL)->locale('id')->isoFormat('D MMMM Y');
        $data = ['news' => $news, 'complaint' => $complaint];
        $pdf = Pdf::loadView('complaint.admin.export.pdf', $data);
        return $pdf->download('BA.pdf');
        // return view('complaint.admin.export.pdf', $data);
    }
}
