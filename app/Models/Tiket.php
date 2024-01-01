<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Tiket extends Model
{
    use HasFactory;
    protected $table = 'tiket';
    protected $guarded = ['id'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }


    public function status()
    {
        if ($this->status === 0) {
            return '<span class="badge badge-warning">Tidak Aktif</span>';
        } else if ($this->status == 1) {
            return '<span class="badge badge-success">Aktif</span>';
        } else if ($this->status == 2) {
            return '<span class="badge badge-danger">Sudah Dipakai</span>';
        } else if ($this->status == 3) {
            return '<span class="badge badge-info">kedaluwarsa</span>';
        } else if ($this->status == 4) {
            return '<span class="badge badge-primary">Pengembalian Dana</span>';
        }
    }

    public static function getStatus()
    {
        $data = collect([
            [
                'nilai' => 0,
                'keterangan' => 'Tidak Aktif'
            ],
            [
                'nilai' => 1,
                'keterangan' => 'AKtif'
            ],
            [
                'nilai' => 2,
                'keterangan' => 'Sudah Dipakai'
            ],
            [
                'nilai' => 3,
                'keterangan' => 'kedaluwarsa'
            ],
            [
                'nilai' => 4,
                'keterangan' => 'Pengembalian Dana'
            ]
        ]);

        $objects = $data->map(function ($item) {
            return (object)$item;
        });

        return $objects;
    }

    public static function generateKodeTiket()
    {
        // Ambil tiket terakhir
        $lastTiket = Tiket::select('kode')->orderByDesc('id')->limit(1)->value('kode');

        if ($lastTiket) {
            // Jika ada tiket terakhir, ambil kode dan tambahkan 1
            $newKode = self::incrementKode($lastTiket);
        } else {
            // Jika tidak ada tiket sebelumnya, gunakan awalan "TK"
            $newKode = 'TK';
        }

        return $newKode;
    }

    private static function incrementKode($kode)
    {
        // Ambil angka dari kode tiket terakhir
        $lastNumber = intval(substr($kode, 3));

        // Tambahkan 1 ke angka tersebut
        $newNumber = $lastNumber + 1;

        // Format ulang angka ke dalam format tiga digit dengan awalan "TK"
        $newKode = 'TK' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $newKode;
    }

    public function gambarBarcode()
    {
        $image = QrCode::generate($this->kode);
        return $image;
    }
}
