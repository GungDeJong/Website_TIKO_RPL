<?php

namespace App\Http\Controllers;

use App\Models\Artis;
use App\Models\Konser;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data_artis = Artis::orderBy('nama', 'ASC')->get();
        $total = [
            'event' => Konser::count(),
            'artis' => Artis::count(),
            'berita' => Post::count()
        ];
        $latest_event = Konser::latest()->limit(3)->get();
        $latest_news = Post::latest()->limit(3)->get();
        $pengaturan = Setting::first();
        return view('frontend.pages.home', [
            'title' => 'Selamat Datang Di TIKO',
            'posts' => Post::latest()->paginate(16),
            'data_artis' => $data_artis,
            'total' => $total,
            'latest_event' => $latest_event,
            'latest_news' => $latest_news,
            'pengaturan' => $pengaturan
        ]);
    }
}
