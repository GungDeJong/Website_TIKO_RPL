<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konser extends Model
{
    use HasFactory;
    protected $table = 'konser';
    protected $guarded = ['id'];
    public $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime'
    ];

    public function artis()
    {
        return $this->hasMany(Artis::class);
    }

    public function tiket()
    {
        return $this->hasMany(KonserTiket::class, 'konser_id', 'id');
    }

    public function gambar()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        } else {
            return asset('assets/img/news/img01.jpg');
        }
    }
    public function gambarKategoriTiket()
    {
        if ($this->gambar_kategori_tiket) {
            return asset('storage/' . $this->gambar_kategori_tiket);
        } else {
            return asset('assets/img/news/img01.jpg');
        }
    }

    public function tanggal_mulai_format()
    {
        return $this->tanggal_mulai->translatedFormat('d F Y H:i:s');
    }
    public function tanggal_selesai_format()
    {
        return $this->tanggal_selesai->translatedFormat('d F Y H:i:s');
    }

    public function status()
    {
        if ($this->status === 1) {
            return '<span class="badge badge-success">Aktif</span>';
        } else {
            return '<span class="badge badge-danger">Tidak Aktif</span>';
        }
    }

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
}
