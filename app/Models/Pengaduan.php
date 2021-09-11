<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nohak', 'noberkas', 'tahun_berkas', 'alamat', 'deskripsi'
    ];
    public function pengaduankomen()
    {
        return $this->hasMany(PengaduanKomen::class);
    }
}