<?php

namespace App\Http\Controllers;

use App\Models\Artis;
use Illuminate\Http\Request;

class ArtisController extends Controller
{
    public function index()
    {
        $items = Artis::latest()->paginate(12);
        return view('frontend.pages.artis.index', [
            'title' => 'List Artis',
            'items' => $items
        ]);
    }
}
