<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artis extends Model
{
    use HasFactory;
    protected $table = 'artis';
    protected $guarded = ['id'];

    public function foto()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        } else {
            return asset('assets/img/stisla.svg');
        }
    }
}
