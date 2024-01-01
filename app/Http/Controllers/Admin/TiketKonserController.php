<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konser;
use App\Models\KonserTiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TiketKonserController extends Controller
{
    public function index()
    {
        $konser = Konser::where('uuid', request('uuid_konser'))->firstOrFail();
        $items = KonserTiket::where('konser_id', $konser->id)->get();
        return view('admin.pages.tiket-konser.index', [
            'title' => 'Data Tiket',
            'konser' => $konser,
            'items' => $items
        ]);
    }

    public function create()
    {
        $konser = Konser::where('uuid', request('uuid_konser'))->firstOrFail();
        return view('admin.pages.tiket-konser.create', [
            'title' => 'Tambahkan Tiket',
            'konser' => $konser
        ]);
    }

    public function store()
    {
        request()->validate([
            'tipe' => ['required'],
            'harga' => ['required'],
            'jumlah' => ['required']
        ]);


        DB::beginTransaction();

        try {
            $konser = Konser::where('uuid', request('uuid_konser'))->firstOrFail();
            $data = request()->all();
            $data['konser_id'] = $konser->id;
            $data['sisa'] = $data['jumlah'];
            KonserTiket::create($data);
            DB::commit();
            return redirect()->route('admin.tiket-konser.index', ['uuid_konser' => $konser->uuid])->with('success', 'Tiket berhasil ditambahkan ke konser');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        $item = KonserTiket::with('konser')->findOrFail($id);
        $konser = $item->konser;
        return view('admin.pages.tiket-konser.edit', [
            'title' => 'Edit Tiket',
            'item' => $item,
            'konser' => $konser
        ]);
    }

    public function update($id)
    {
        request()->validate([
            'tipe' => ['required'],
            'harga' => ['required'],
            'jumlah' => ['required']
        ]);


        DB::beginTransaction();

        try {
            $item = KonserTiket::with('konser')->findOrFail($id);
            $data = request()->all();
            $data['sisa'] = $data['jumlah'];
            $jumlah_sebelumnya = $item->jumlah;
            $data['sisa'] = ($data['jumlah'] - $jumlah_sebelumnya) + $item->sisa;
            $item->update($data);
            DB::commit();
            return redirect()->route('admin.tiket-konser.index', ['uuid_konser' => $item->konser->uuid])->with('success', 'Tiket berhasil ditambahkan ke konser');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            KonserTiket::find($id)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Tiket berhasil dihapus dari konser');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
