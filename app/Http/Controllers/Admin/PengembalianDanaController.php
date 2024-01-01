<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengembalianDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianDanaController extends Controller
{
    public function index()
    {
        $items = PengembalianDana::with(['tiket'])->latest()->get();
        return view('admin.pages.pengembalian-dana.index', [
            'title' => 'Data Pengembalian Dana',
            'items' => $items
        ]);
    }

    public function edit($id)
    {
        $item = PengembalianDana::findOrFail($id);
        $data_status = PengembalianDana::getStatus();
        return view('admin.pages.pengembalian-dana.edit', [
            'title' => 'Edit Pengembalian Dana',
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
            $item = PengembalianDana::with('tiket')->findOrFail($id);
            $item->update([
                'status' => request('status')
            ]);
            // update status tiket jadi refund atau 3
            if ($item->status != request('status')) {
                if (request('status') == 1) {
                    $item->tiket->update([
                        'status' => 3
                    ]);
                }
            }
            $item->tiket->update([
                'status' => 3
            ]);
            DB::commit();

            return redirect()->route('admin.pengembalian-dana.index')->with('success', 'Pengembalian Dana berhasil diupdate');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            PengembalianDana::find($id)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Pengembalian Dana berhasil dihapus.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
