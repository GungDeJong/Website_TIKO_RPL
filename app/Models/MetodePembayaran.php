<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;
    protected $table = 'metode_pembayaran';
    protected $guarded = ['id'];

    public function logo()
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        } else {
            return asset('assets/img/stisla.svg');
        }
    }
}
