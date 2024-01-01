<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count = [
            'user' => User::count(),
            'transaksi' => Transaksi::count(),
            'tiket' => Tiket::count(),
            'berita' => Post::count()
        ];
        $transaksi_terbaru = Transaksi::latest()->limit(10)->get();
        return view('admin.pages.dashboard', [
            'title' => 'Dashboard',
            'count' => $count,
            'transaksi_terbaru' => $transaksi_terbaru
        ]);
    }
}
