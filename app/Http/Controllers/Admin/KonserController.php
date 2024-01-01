<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artis;
use App\Models\Konser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KonserController extends Controller
{
    public function index()
    {
        $data_konser = Konser::latest()->get();
        return view('admin.pages.konser.index', [
            'title' => 'Data Konser',
            'data_konser' => $data_konser
        ]);
    }


    public function create()
    {
        return view('admin.pages.konser.create', [
            'title' => 'Tambah Data',
            'data_artis' => Artis::orderBy('nama')->get(),
        ]);
    }

    public function edit($uuid)
    {
        $item = Konser::where('uuid', $uuid)->firstOrFail();
        return view('admin.pages.konser.edit', [
            'title' => 'Edit Data',
            'item' => $item,
            'data_artis' => Artis::orderBy('nama', 'ASC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'nama' => ['required'],
            'tanggal_mulai' => ['required'],
            'status' => ['required'],
            'tanggal_selesai' => ['required'],
            'deskripsi' => ['required'],
            'gambar' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'gambar_kategori_tiket' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048']
        ]);

        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['gambar'] = request()->file('gambar')->store('konser', 'public');
            $data['gambar_kategori_tiket'] = request()->file('gambar_kategori_tiket')->store('kategori-tiket', 'public');
            $data['uuid'] = \Str::uuid();
            Konser::create($data);
            DB::commit();
            return redirect()->route('admin.konser.index')->with('success', 'Data Konser berhasil ditambahkan.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('admin.konser.index')->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        $item = Konser::with('category', 'user', 'tags')->findOrFail($id);
        return view('admin.pages.konser.show', [
            'title' => 'Detail Konser ' . $item->title,
            'item' => $item
        ]);
    }

    public function update($uuid)
    {

        request()->validate([
            'nama' => ['required'],
            'tanggal_mulai' => ['required'],
            'tanggal_selesai' => ['required'],
            'deskripsi' => ['required'],
            'status' => ['required'],
            'gambar' => ['image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'gambar_kategori_tiket' => ['image', 'mimes:jpg,png,jpeg', 'max:2048']
        ]);

        DB::beginTransaction();
        try {
            $item = Konser::where('uuid', $uuid)->firstOrFail();
            $data = request()->all();
            if (request()->file('gambar')) {
                Storage::disk('public')->delete($item->gambar);
                $data['gambar'] = request()->file('gambar')->store('konser', 'public');
            }
            if (request()->file('gambar_kategori_tiket')) {
                Storage::disk('public')->delete($item->gambar_kategori_tiket);
                $data['gambar_kategori_tiket'] = request()->file('gambar_kategori_tiket')->store('kategori-tiket', 'public');
            }
            $item->update($data);
            DB::commit();
            return redirect()->route('admin.konser.index')->with('success', 'Data Konser berhasil diupdate.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('admin.konser.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        DB::beginTransaction();
        try {
            Konser::where('uuid', $uuid)->firstOrFail()->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Data Konser berhasil dihapus.']);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json(['status' => 'success', 'message' => $th->getMessage()]);
        }
    }
}
