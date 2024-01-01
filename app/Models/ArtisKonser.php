<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtisKonser extends Model
{
    use HasFactory;
    protected $table = 'artis_konser';
    protected $guarded = ['id'];

    public function artis()
    {
        return $this->belongsTo(Artis::class);
    }
    public function konser()
    {
        return $this->belongsTo(Konser::class);
    }
}
