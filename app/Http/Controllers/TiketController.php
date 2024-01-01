<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        $items = Tiket::whereHas('transaksi', function ($q) {
            $q->where('user_id', auth()->id());
        })->latest()->get();
        return view('frontend.pages.tiket.index', [
            'title' => 'Tiket',
            'items' => $items,
        ]);
    }
}
