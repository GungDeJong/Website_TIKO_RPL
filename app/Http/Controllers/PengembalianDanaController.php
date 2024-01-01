<?php

namespace App\Http\Controllers;

use App\Models\PengembalianDana;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianDanaController extends Controller
{
    public function index()
    {
        $items = PengembalianDana::where('user_id', auth()->id())->latest()->get();
        return view('frontend.pages.pengembalian-dana.index', [
            'title' => 'Pengembalian Dana',
            'items' => $items,
        ]);
    }

    public function create()
    {
        $data_tiket = Tiket::where('status', 1)->whereHas('transaksi', function ($q) {
            $q->where('user_id', auth()->id());
        })->latest()->get();
        return view('frontend.pages.pengembalian-dana.create', [
            'title' => 'Pengajuan Pengembalian Dana',
            'data_tiket' => $data_tiket,
        ]);
    }

    public function store()
    {
        request()->validate([
            'tiket_id' => ['required'],
            'nama_bank' => ['required'],
            'nomor_rekening' => ['required', 'numeric'],
            'pemilik' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $tiket = Tiket::findOrFail(request('tiket_id'));
            PengembalianDana::create([
                'user_id' => auth()->id(),
                'tiket_id' => request('tiket_id'),
                'harga' => $tiket->transaksi->tiket->harga,
                'nama_bank' => request('nama_bank'),
                'nomor_rekening' => request('nomor_rekening'),
                'pemilik' => request('pemilik'),
                'status' => 0
            ]);
            DB::commit();
            return redirect()->route('pengembalian-dana.index')->with('success', 'Pengembalian Dana berhasil diajukan.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
