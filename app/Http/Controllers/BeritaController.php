<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $keyword = request('keyword');
        if ($keyword)
            $posts = Post::active()->where('title', 'LIKE', '%' . $keyword . '%')->latest()->paginate(12);
        else
            $posts = Post::active()->latest()->paginate(12);
        return view('frontend.pages.post.index', [
            'title' => 'Berita Terbaru',
            'posts' => $posts
        ]);
    }

    public function show($slug)
    {
        $item = Post::active()->where('slug', $slug)->firstOrFail();
        return view('frontend.pages.post.show', [
            'title' => 'Berita Terbaru',
            'item' => $item
        ]);
    }
}
