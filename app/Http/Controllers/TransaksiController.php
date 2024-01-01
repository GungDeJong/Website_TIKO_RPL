<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\KonserTiket;
use App\Models\MetodePembayaran;
use App\Models\Tiket;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $items = Transaksi::where('user_id', auth()->id())->latest()->get();
        return view('frontend.pages.transaksi.index', [
            'title' => 'History Transaksi',
            'items' => $items,
        ]);
    }

    public function show($kode)
    {
        $item = Transaksi::with(['tiket', 'tikets'])->where([
            'user_id' => auth()->id(),
            'kode' => $kode
        ])->firstOrFail();
        return view('frontend.pages.transaksi.show', [
            'title' => 'Detail Transaksi ' . $item->kode,
            'item' => $item,
        ]);
    }

    public function pilih_tiket($uuid)
    {
        $item = Konser::with('tiket')->where('uuid', $uuid)->firstOrFail();
        $data_metode_pembayaran = MetodePembayaran::orderBy('nama', 'ASC')->get();
        return view('frontend.pages.transaksi.pilih-tiket', [
            'title' => $item->nama,
            'item' => $item,
            'data_metode_pembayaran' => $data_metode_pembayaran
        ]);
    }

    public function checkout()
    {
        request()->validate([
            'konser_id' => ['required'],
            'konser_tiket_id' => ['required'],
            'metode_pembayaran_id' => ['required'],
            'jumlah_tiket' => ['required']
        ]);

        DB::beginTransaction();
        try {
            // cek sisa tiket
            $jumlah_tiket = KonserTiket::findOrFail(request('konser_tiket_id'))->jumlah;
            $terjual = Transaksi::where([
                'konser_id' => request('konser_id'),
                'status' => 1
            ])->sum('jumlah');
            $sisa = $jumlah_tiket - $terjual;
            if ($sisa < request('jumlah_tiket')) {
                return redirect()->back()->with('error', 'Kuota tiket tidak mencukupi!');
            }
            $nama_tiket = request('nama');
            $konser_tiket = KonserTiket::findOrFail(request('konser_tiket_id'));
            $total = $konser_tiket->harga * request('jumlah_tiket');
            // buatkan transaksi
            $transaksi = Transaksi::create([
                'kode' => Transaksi::generateKodeTransaksi(),
                'user_id' => auth()->id(),
                'konser_tiket_id' => request('konser_tiket_id'),
                'metode_pembayaran_id' => request('metode_pembayaran_id'),
                'konser_id' => request('konser_id'),
                'jumlah' => request('jumlah_tiket'),
                'total_harga' => $total,
                'status' => 0
            ]);

            // buat tiket
            foreach ($nama_tiket as $nama) {
                Tiket::create([
                    'transaksi_id' => $transaksi->id,
                    'nama' => $nama,
                    'status' => 0,
                    'kode' => Tiket::generateKodeTiket()
                ]);
            }
            DB::commit();
            return redirect()->route('transaksi.show', $transaksi->kode)->with('success', 'Tiket berhasil dipesan. Silahkan bayar!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
