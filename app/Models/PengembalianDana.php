<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianDana extends Model
{
    use HasFactory;
    protected $table = 'pengembalian_dana';
    protected $guarded = ['id'];

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }


    public function status()
    {
        if ($this->status === 0) {
            return '<span class="badge badge-warning">IN PROGRESS</span>';
        } else if ($this->status == 1) {
            return '<span class="badge badge-success">ACCEPTED</span>';
        } else if ($this->status == 2) {
            return '<span class="badge badge-danger">REJECTED</span>';
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
                'keterangan' => 'ACCEPTED'
            ],
            [
                'nilai' => 2,
                'keterangan' => 'REJECTED'
            ]
        ]);

        $objects = $data->map(function ($item) {
            return (object)$item;
        });

        return $objects;
    }
}
