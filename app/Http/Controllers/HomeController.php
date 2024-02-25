<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(Request $request): Response
    {
        $posts = PostResource::collection(Post::query()->latest()->paginate(10));
        $status = session('status');

        return Inertia::render('Home', compact('posts', 'status'));
    }
}
