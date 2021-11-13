<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanKomen extends Model
{
    use HasFactory;
    protected $fillable = [
        'komen', 'pengaduan_id', 'admin_id'
    ];
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
