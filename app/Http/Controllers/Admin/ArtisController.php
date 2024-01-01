<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ArtisController extends Controller
{
    public function index()
    {
        return view('admin.pages.artis.index', [
            'title' => 'Data Artis'
        ]);
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Artis::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-nama='$model->nama' data-genre='$model->genre' data-gambar='$model->gambar' data-albumterkenal='$model->album_terkenal'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-nama='$model->nama'><i class='fas fa fa-trash'></i> Hapus</button>";
                    return $action;
                })
                ->editColumn('foto', function ($model) {
                    return '<img src="' . $model->foto() . '" class="img-fluid" style="max-height:50px">';
                })
                ->rawColumns(['action', 'foto'])
                ->make(true);
        }
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
            'genre' => ['required'],
            'album_terkenal' => ['required'],
            'foto' => ['image', 'max:2048']
        ]);

        $artis = Artis::find(request('id'));
        if (request()->file('foto')) {
            if (request('id')) {
                if ($artis->foto)
                    Storage::delete($artis->foto);
                $foto = request()->file('foto')->store('artis', 'public');
            } else {
                $foto = request()->file('foto')->store('artis', 'public');
            }
        } else {
            if (request('id'))
                $foto = $artis->foto;
            else
                $foto = NULL;
        }

        Artis::updateOrCreate([
            'id'  => request('id')
        ], [
            'nama' => request('nama'),
            'genre' => request('genre'),
            'album_terkenal' => request('album_terkenal'),
            'foto' => $foto
        ]);

        if (request('id')) {
            $message = 'Artis berhasil disimpan.';
        } else {
            $message = 'Artis berhasil ditambahakan.';
        }
        return response()->json(['status' => 'succcess', 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Artis::find($id)->delete();
        return response()->json(['status' => 'succcess', 'message' => 'Data Artis berhasil dihapus.']);
    }
}
