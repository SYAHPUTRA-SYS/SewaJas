<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Pelanggan;
use App\Models\Jas;
use Illuminate\Support\Str;
class PemesananJas extends Model
{
    protected $table = 'pemesanan_jas';
    protected $fillable = [
        'kode_verifikasi',
        'pelanggan_id',
        'jas_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'tanggal_sidang',
        'jumlah',
        'total_harga',
        'denda',
        'status',
        'pembayaran',
        'catatan',
    ];

    protected $casts = [
        'tanggal_sewa' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_sidang' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->kode_verifikasi)) {
                $model->kode_verifikasi = strtoupper(Str::random(10));
            }
        });
    }

    // Relasi ke pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    // Relasi ke jas
    public function jas()
    {
        return $this->belongsTo(Jas::class);
    }

    /**
     * Accessor untuk status dengan label warna
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'booking' => '<span class="badge bg-warning">Booking</span>',
            'diambil' => '<span class="badge bg-info">Diambil</span>',
            'kembali' => '<span class="badge bg-success">Kembali</span>',
            'batal' => '<span class="badge bg-danger">Batal</span>',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Accessor untuk pembayaran dengan label warna
     */
    public function getPembayaranLabelAttribute()
    {
        $labels = [
            'belum_bayar' => '<span class="badge bg-danger">Belum Bayar</span>',
            'dp' => '<span class="badge bg-warning">DP</span>',
            'lunas' => '<span class="badge bg-success">Lunas</span>',
        ];
        return $labels[$this->pembayaran] ?? $this->pembayaran;
    }
}
