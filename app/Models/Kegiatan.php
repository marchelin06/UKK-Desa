<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kegiatan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tujuan',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'penyelenggara',
        'penanggung_jawab',
        'kategori',
        'peserta',
        'jumlah_peserta',
        'status',
        'foto',
        'hasil',
        'anggaran',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'peserta' => 'array',
    ];

    protected $dates = ['tanggal_mulai', 'tanggal_selesai', 'deleted_at'];

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'direncanakan' => 'badge-info',
            'berlangsung' => 'badge-warning',
            'selesai' => 'badge-success',
            'dibatalkan' => 'badge-danger',
            default => 'badge-secondary'
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'direncanakan' => 'Direncanakan',
            'berlangsung' => 'Berlangsung',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default => 'Tidak Diketahui'
        };
    }

    public function getKategoriLabelAttribute()
    {
        return match($this->kategori) {
            'Umum' => 'Umum',
            'Sosial' => 'Sosial',
            'Infrastruktur' => 'Infrastruktur',
            'Pendidikan' => 'Pendidikan',
            'Kesehatan' => 'Kesehatan',
            'Keagamaan' => 'Keagamaan',
            'Olahraga' => 'Olahraga',
            default => 'Lainnya'
        };
    }
}

