<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class ComplaintController extends Controller
{
    public function index()
    {
        return view('complaint.user.index');
    }

    public function create()
    {
        $complaintTicket = 'SIMRS' . date('Ymd') . round(microtime(true) * 1000);

        $data = [
            'complaintTicket' => $complaintTicket,
        ];
        return view('complaint.user.create', $data);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validation = $this->validation($request);

            if ($validation->fails()) {
                return response()->json([
                    'code' => 400,
                    'message' => $validation->messages(),
                ]);
            } else {
                // $data = $request->all();
                $data = [
                    'UUID' => Uuid::uuid6()->toString(),
                    'TANGGAL_PENGADUAN' => date('y-m-d'),
                    'KODE_PENGADUAN' => $request->complaint_ticket,
                    'TANGGAL_INPUT' => $request->reported_name,
                    'TANGGAL_KEJADIAN' => date('Y-m-d H:i:s'),
                    'NAMA_BARANG' => $request->nama_barang,

                    'KONDISI_IGD' => $request->desc,
                    'STATUS' => 1,
                    'KETERANGAN_SHIFT' => $request->priority,
                    'NAMA_PETUGAS' => $request->nama_petugas,
                    'IDENTITAS' => $request->identitas,
                    'KETERANGAN' => 'Diproses',
                ];
                if ($request->hasFile('file')) {
                    $data['FILE'] = $request->file = $request->file('file')->storeAs('uploads', 'Complaint_' . $request->complaint_ticket . '.' . $request->file->extension());
                }
                $complaint = Complaint::create($data);

                $complaint->save();

                return response()->json([
                    'code' => 200,
                    'message' => 'Sukses',
                    'ticket' => $request->complaint_ticket,
                ]);
            }
        }
    }

    public function show()
    {
        return view('complaint.user.show');
    }

    public function validation(Request $request)
    {
        $rules = [
            'complaint_ticket' => 'required',
            'reported_name' => 'required',
            // 'desc' => 'required',
            // 'identitas' => 'required',
            'file' => ['file', 'max:4096', 'mimes:jpg,jpeg,png'],
        ];

        $messages = [
            'reported_name.required' => 'Nama terlapor harus diisi',
            'desc.required' => 'Kondisi IGD Pengaduan harus diisi',
            'file.required' => 'Lampiran bukti harus diisi',
            'file.max' => 'Lampiran bukti maksimal 4 mb',
            'file.mimes' => 'Isi lampiran bukti dengan format yang disarankan',
            'reporter_name.required' => 'Nama pelapor harus diisi',
            'reporter_address.required' => 'Alamat pelapor harus diisi',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
