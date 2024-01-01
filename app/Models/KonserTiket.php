<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonserTiket extends Model
{
    use HasFactory;
    protected $table = 'konser_tiket';
    protected $guarded = ['id'];

    public function konser()
    {
        return $this->belongsTo(Konser::class);
    }
}
