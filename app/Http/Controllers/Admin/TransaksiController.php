<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $items = Transaksi::with(['user', 'tiket', 'metode_pembayaran'])->latest()->get();
        return view('admin.pages.transaksi.index', [
            'title' => 'Data Transaksi',
            'items' => $items
        ]);
    }

    public function edit($id)
    {
        $item = Transaksi::findOrFail($id);
        if ($item->status == 1)
            return redirect()->route('admin.transaksi.index');
        $data_status = Transaksi::getStatus();
        return view('admin.pages.transaksi.edit', [
            'title' => 'Edit Transaksi',
            'item' => $item,
            'data_status' => $data_status
        ]);
    }

    public function update($id)
    {
        request()->validate([
            'status' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $item = Transaksi::findOrFail($id);
            // cek jika status COMPLETED
            if (request('status') == 1) {
                if ($item->status != request('status')) {

                    $sisa_awal = $item->tiket->jumlah;
                    $sisa_akhir = $sisa_awal - $item->jumlah;

                    // udpate sisa tiket
                    $item->tiket->update([
                        'sisa' => $sisa_akhir
                    ]);
                    // buatkan tiket
                    foreach ($item->tikets as $tiket) {
                        $tiket->update([
                            'status' => 1
                        ]);
                    }
                }
            }
            $item->update([
                'status' => request('status')
            ]);

            DB::commit();

            return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil diupdate');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Transaksi::find($id)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
