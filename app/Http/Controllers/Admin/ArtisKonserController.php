<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artis;
use App\Models\ArtisKonser;
use App\Models\Konser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtisKonserController extends Controller
{
    public function index()
    {
        $konser = Konser::where('uuid', request('uuid_konser'))->firstOrFail();
        $items = ArtisKonser::where('konser_id', $konser->id)->get();
        return view('admin.pages.artis-konser.index', [
            'title' => 'Data Konser Artis',
            'konser' => $konser,
            'items' => $items
        ]);
    }

    public function create()
    {
        $konser = Konser::where('uuid', request('uuid_konser'))->firstOrFail();
        $data_artis = Artis::orderBy('nama', 'ASC')
            ->whereNotIn('id', function ($query)  use ($konser) {
                $query->select('artis_id')->from('artis_konser')->where('konser_id', $konser->id);
            })
            ->get();
        return view('admin.pages.artis-konser.create', [
            'title' => 'Tambahkan Artis',
            'konser' => $konser,
            'data_artis' => $data_artis
        ]);
    }

    public function store()
    {
        request()->validate([
            'artis_id' => ['required']
        ]);


        DB::beginTransaction();

        try {
            $data_artis_id = request('artis_id');
            $konser = Konser::where('uuid', request('uuid_konser'))->firstOrFail();
            foreach ($data_artis_id as $artis) {
                ArtisKonser::create([
                    'artis_id' => $artis,
                    'konser_id' => $konser->id
                ]);
            };
            DB::commit();
            return redirect()->route('admin.artis-konser.index', ['uuid_konser' => $konser->uuid])->with('success', 'Artis berhasil ditambahkan ke konser');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            ArtisKonser::find($id)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Artis berhasil dihapus dari konser');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
