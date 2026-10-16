<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jas extends Model
{
    protected $fillable = [
        'kode_jas',
        'jenis',
        'ukuran',
        'stok',
        'harga_sewa_per_hari',
        'denda_terlambat',
        'keterangan',
        'is_available'
    ];

     protected $casts = [
        'is_available' => 'boolean',
    ];

    // Relasi ke pemesanan_jas
    public function pemesanans()
    {
        return $this->hasMany(PemesananJas::class);
    }

    // Scope untuk jas yang tersedia
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)->where('stok', '>', 0);
    }

    // Accessor untuk label jenis
    public function getJenisLabelAttribute()
    {
        $labels = [
            'toga' => 'Toga',
            'jas_almamater' => 'Jas Almamater',
            'kebaya' => 'Kebaya'
        ];
        return $labels[$this->jenis] ?? $this->jenis;
    }
}
