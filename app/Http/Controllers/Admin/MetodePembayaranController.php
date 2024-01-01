<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        return view('admin.pages.metode-pembayaran.index', [
            'title' => 'Data Metode Pembayaran'
        ]);
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = MetodePembayaran::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-nama='$model->nama' data-nomor='$model->nomor' data-pemilik='$model->pemilik'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-nama='$model->nama'><i class='fas fa fa-trash'></i> Hapus</button>";
                    return $action;
                })
                ->editColumn('logo', function ($model) {
                    return '<img src="' . $model->logo() . '" class="img-fluid" style="max-height:50px">';
                })
                ->rawColumns(['action', 'logo'])
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
            'nomor' => ['required', 'numeric'],
            'pemilik' => ['required'],
            'logo' => ['image', 'max:2048']
        ]);
        $item = MetodePembayaran::find(request('id'));
        if (request()->file('logo')) {
            if (request('id')) {
                if ($item->logo)
                    Storage::delete($item->logo);
                $logo = request()->file('logo')->store('metode-pembayaran', 'public');
            } else {
                $logo = request()->file('logo')->store('metode-pembayaran', 'public');
            }
        } else {
            if (request('id'))
                $logo = $item->logo;
            else
                $logo = NULL;
        }
        MetodePembayaran::updateOrCreate([
            'id'  => request('id')
        ], [
            'nama' => request('nama'),
            'nomor' => request('nomor'),
            'pemilik' => request('pemilik'),
            'logo' => $logo
        ]);

        if (request('id')) {
            $message = 'Metode Pembayaran berhasil disimpan.';
        } else {
            $message = 'Metode Pembayaran berhasil ditambahakan.';
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
        MetodePembayaran::find($id)->delete();
        return response()->json(['status' => 'succcess', 'message' => 'Data Metode Pembayaran berhasil dihapus.']);
    }
}
