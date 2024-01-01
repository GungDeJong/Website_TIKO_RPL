<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $keyword = request('keyword');
        if ($keyword)
            $items = Konser::active()->where('nama', 'LIKE', '%' . $keyword . '%')->latest()->paginate(12);
        else
            $items = Konser::active()->latest()->paginate(12);
        return view('frontend.pages.konser.index', [
            'title' => 'Event Terbaru',
            'items' => $items
        ]);
    }

    public function show($uuid)
    {
        $item = Konser::active()->with('tiket')->where('uuid', $uuid)->firstOrFail();
        return view('frontend.pages.konser.show', [
            'title' => $item->nama,
            'item' => $item
        ]);
    }
}
