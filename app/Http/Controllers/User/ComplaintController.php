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
        // $complaint = Complaint::select('ID_PELANGGARAN', DB::raw('COUNT(ID_PELANGGARAN) as JUMLAH'))
        //     ->whereMonth('TANGGAL_PENGADUAN', date('m'))->groupBy('ID_PELANGGARAN')->get();
        // $c = [];
        // $v = [];

        // foreach ($complaint as $key) {
        //     $c[] = $key->JUMLAH;
        //     $v[] = $key->violation->NAMA;
        // }

        // $data = [
        //     'complaint' => $c,
        //     'violation' => $v,
        // ];

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
                    'UUID'              => Uuid::uuid6()->toString(),
                    'TANGGAL_PENGADUAN' => date('y-m-d'),
                    'KODE_PENGADUAN'    => $request->complaint_ticket,
                    'NAMA_TERLAPOR'     => $request->reported_name,
                    // 'LOKASI'            => $request->address,
                    'TANGGAL_KEJADIAN'  => date('Y-m-d H:i:s'),
                    'NAMA_BARANG'       => $request->nama_barang,
                    // 'VOLUME'            => $request->volume,
                    'KATEGORI'          => $request->category,
                    'URAIAN'            => $request->desc,
                    'STATUS'            => 1,
                    'PRIORITAS'         => $request->priority,
                    'KETERANGAN'        => 'Diproses',
                ];
                if ($request->hasFile('file')) {
                    $data['FILE'] = $request->file = $request->file('file')->storeAs('uploads', 'Complaint_' . $request->complaint_ticket . '.' . $request->file->extension());
                }
                $complaint = Complaint::create($data);

                $complaint->save();

                return response()->json([
                    'code' => 200,
                    'message' => 'Sukses',
                    'ticket' => $request->complaint_ticket
                ]);
            }
        }
    }

    public function show()
    {
        return view('complaint.user.show');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $complaintTicket = $request->get('complaint');
            $output = '';

            $query = Complaint::where('KODE_PENGADUAN', $complaintTicket)->first();

            if ($query) {
                if ($query->STATUS === 1) {
                    $asset = "assets/images/landing/warning.png";
                    $message = 'Pengaduan Masuk';
                } else if ($query->STATUS === 2) {
                    $asset = "assets/images/landing/warning.png";
                    $message = 'Diproses';
                } else if ($query->STATUS === 3){
                    $asset = "assets/images/landing/warning.png";
                    $message = 'Diproses';
                } else if ($query->STATUS === 4) {
                    $asset = "assets/images/landing/checklist.png";
                    $message = 'Selesai';
                }

                $output .= '
                    <div class="card" id="search_result">
                        <div class="card-header" style="background-color: #4154f1">
                            <div class="container">
                                <div class="d-flex justify-content-between text-start">
                                    <span class="fw-bold text-white">Tiket Pengaduan</span>
                                    <span class="fw-bold text-white">SIM RSUD Kota Bogor</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 text-start mt-3">
                                        <div>
                                            <p class="fs-6 m-0">Nomor Pengaduan</p>
                                            <h5 class="fw-bold">' . $query->KODE_PENGADUAN . '</h5>
                                        </div>
                                        <div class="">
                                            <p class="fs-6 m-0">Tanggal Pengaduan</p>
                                            <h5 class="fw-bold">' . $query->setDateFormat($query->TANGGAL_PENGADUAN) . '</h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-start mt-3">
                                        <div>
                                            <p class="fs-6 m-0">Nama Pelapor</p>
                                            <h5 class="fw-bold">' . $query->NAMA_TERLAPOR . '</h5>
                                        </div>
                                        <div class="">
                                            <p class="fs-6 m-0">Note</p>
                                            <h5 class="fw-bold">' . $query->NOTES . '</h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-start mt-3">
                                        <div>
                                            <p class="fs-6 m-0">Lihat Hasil Pengerjaan</p>
                                            <div>
                                                <button class="btn btn-pill btn-primary btn-sm" type="button"
                                                data-bs-target="#lihat_pekerjaan" data-bs-toggle="modal"
                                                type="button">Foto</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="text-center">
                                            <img src="' . asset($asset) . '" alt="" srcset="" class="img-fluid">
                                            <p class="m-0 fw-bold">' . $message . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="lihat_pekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Foto Selesai Pengerjaan</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="' . asset('storage/' . $query->FILE_SELESAI) . '" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            } else {
                $output .= '
                    <div class="card" style="border-width: 2px; border-color: #dc3545">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <img src="' . asset('assets/images/landing/cancel.png') . '" alt="" srcset="">
                                            <div class="fs-3 fw-bold" style="color: #dc3545">Data Pengaduan Tidak Ditemukan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }

            return response()->json([
                'complaint' => $output
            ]);
        }
    }

    public function validation(Request $request)
    {
        $rules = [
            'complaint_ticket'      => 'required',
            'reported_name'         => 'required',
            // 'address'               => 'required',
            'desc'                  => 'required',
            // 'volume'                => 'required|numeric',
            'file'                  => [
                'file',
                'max:10240',
                'mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,avi,mp4,3gp,mp3'
            ],

            // 'reporter_name'         => 'required',
            // 'province'              => 'required',
            // 'regency'               => 'required',
            // 'district'              => 'required',
            // 'village'               => 'required',
            // 'reporter_address'      => 'required',
            // 'g-recaptcha-response'  => [
            //     'required', function ($attribute, $value, $fail) {
            //         $secret = config('services.gcaptcha.secret');
            //         $remote = $_SERVER['REMOTE_ADDR'];
            //         $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$value&remoteip=$remote";
            //         $response = \file_get_contents($url);
            //         $response = json_decode($response);
            //         if (!$response->success) {
            //             $fail('Captcha error');
            //         }
            //     }
            // ],
        ];

        $messages = [
            'complaint_ticket.required'     => 'Nomor pengaduan harus diisi',
            // 'violation_type.required'       => 'Jenis pelanggaran harus diisi',
            'reported_name.required'        => 'Nama terlapor harus diisi',
            // 'address.required'              => 'Lokasi kejadian harus diisi',
            'desc.required'                 => 'Uraian Pengaduan harus diisi',
            'file.required'                 => 'Lampiran bukti harus diisi',
            'file.max'                      => 'Lampiran bukti maksimal 10 mb',
            'file.mimes'                    => 'Isi lampiran bukti dengan format yang disarankan',
            'reporter_name.required'        => 'Nama pelapor harus diisi',
            'reporter_address.required'     => 'Alamat pelapor harus diisi',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
