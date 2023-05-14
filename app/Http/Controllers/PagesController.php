<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    public function index()
    {
		$posts = Post::orderBy('updated_at', 'DESC')->get()->take(4);
        return view('index', compact('posts'));
    }
}
