<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TiketController extends Controller
{
    public function index()
    {
        $items = Tiket::with(['transaksi'])->latest()->get();
        return view('admin.pages.tiket.index', [
            'title' => 'Data Tiket',
            'items' => $items
        ]);
    }

    public function edit($id)
    {
        $item = Tiket::findOrFail($id);
        $data_status = Tiket::getStatus();
        return view('admin.pages.tiket.edit', [
            'title' => 'Edit Tiket',
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
            $item = Tiket::findOrFail($id);
            $item->update([
                'status' => request('status')
            ]);
            DB::commit();

            return redirect()->route('admin.tiket.index')->with('success', 'Transaksi berhasil diupdate');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
