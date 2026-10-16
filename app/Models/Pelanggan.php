<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'nim',
        'nama',
        'jenis_kelamin',
        'no_hp',
        'email',
        'jurusan',
        'alamat',
    ];

    // Relasi ke peminjaman_jas
    public function pemesanans()
    {
        return $this->hasMany(PemesananJas::class);
    }
}
