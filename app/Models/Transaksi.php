<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function konser()
    {
        return $this->belongsTo(Konser::class);
    }
    public function metode_pembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }
    public function tiket()
    {
        return $this->belongsTo(KonserTiket::class, 'konser_tiket_id', 'id');
    }

    public function tikets()
    {
        return $this->hasMany(Tiket::class, 'transaksi_id', 'id');
    }

    public function status()
    {
        if ($this->status === 0) {
            return '<span class="badge badge-warning">IN PROGRESS</span>';
        } else if ($this->status == 1) {
            return '<span class="badge badge-success">COMPLETTED</span>';
        } else if ($this->status == 2) {
            return '<span class="badge badge-danger">FAILED</span>';
        } else if ($this->status == 3) {
            return '<span class="badge badge-primary">CANCELED</span>';
        }
    }

    public static function getStatus()
    {
        $data = collect([
            [
                'nilai' => 0,
                'keterangan' => 'IN PROGRESS'
            ],
            [
                'nilai' => 1,
                'keterangan' => 'COMPLETTED'
            ],
            [
                'nilai' => 2,
                'keterangan' => 'FAILED'
            ],
            [
                'nilai' => 3,
                'keterangan' => 'CANCELED'
            ]
        ]);

        $objects = $data->map(function ($item) {
            return (object)$item;
        });

        return $objects;
    }

    public static function generateKodeTransaksi()
    {
        // Ambil transaksi terakhir
        $lastTransaksi = Transaksi::select('kode')->orderByDesc('id')->limit(1)->value('kode');

        if ($lastTransaksi) {
            // Jika ada transaksi terakhir, ambil kode dan tambahkan 1
            $newKode = self::incrementKode($lastTransaksi);
        } else {
            // Jika tidak ada transaksi sebelumnya, gunakan awalan "TRX001"
            $newKode = 'TRX001';
        }

        return $newKode;
    }

    private static function incrementKode($kode)
    {
        // Ambil angka dari kode transaksi terakhir
        $lastNumber = intval(substr($kode, 3));

        // Tambahkan 1 ke angka tersebut
        $newNumber = $lastNumber + 1;

        // Format ulang angka ke dalam format tiga digit dengan awalan "TRX"
        $newKode = 'TRX' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $newKode;
    }
}
