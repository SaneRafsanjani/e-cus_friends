<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'pengaduan';
    protected $hidden = [
        'UUID'
    ];
    protected $fillable = [
        'UUID',
        'TANGGAL_PENGADUAN',
        'LOKASI',
        'NAMA_BARANG',
        'VOLUME',
        'KATEGORI',
        'TANGGAL_KEJADIAN',
        'URAIAN',
        'FILE',
        'STATUS',
        'KETERANGAN',
        'PRIORITAS',
        'TANGGAL_INPUT',
        'KONDISI_IGD',
        'KETERANGAN_SHIFT'
    ];

    // public function violation()
    // {
    //     return $this->hasOne(Violation::class, 'ID', 'ID_PELANGGARAN');
    // }

    public function setDateFormat($date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM Y');
    }

    public function setMonthFormat($month)
    {
        $format = Carbon::createFromDate(null, $month, null, null)->locale('id');
        return $format->isoFormat('MMMM');
    }

    public function diffinminute($t1, $t2)
    {

        $time1 = Carbon::createFromFormat('Y-m-d H:i:s', $t1);
        $time2 = Carbon::createFromFormat('Y-m-d H:i:s', $t2);
        $diff_in_hours = $time2->diffInMinutes($time1);

        return $diff_in_hours;
    }

    // public function province()
    // {
    //     return $this->hasOne(Province::class, 'ID', 'ID_PROVINSI');
    // }

    // public function regency()
    // {
    //     return $this->hasOne(Regency::class, 'ID', 'ID_KABUPATEN');
    // }

    // public function district()
    // {
    //     return $this->hasOne(District::class, 'ID', 'ID_KECAMATAN');
    // }

    // public function village()
    // {
    //     return $this->hasOne(Village::class, 'ID', 'ID_KELURAHAN');
    // }
}
