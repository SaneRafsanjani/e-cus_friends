<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'berita_acara';
    protected $hidden = [
        'ID',
        'ID_PENGADUAN'
    ];
    protected $fillable = [
        'ID_PENGADUAN',
        'TANGGAL',
        'TEMPAT',
        'PIMPINAN_RAPAT',
        'PEMBAHASAN'
    ];
}
