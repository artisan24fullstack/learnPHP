<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;

class BlogController extends Controller
{
    //    public function index(): Paginator

    public function index(): View
    {
        //return Post::paginate(25);
        //$posts = Post::paginate(25);
        return view('blog.index', [
            'posts' => Post::paginate(1)
        ]);
    }

    //     public function show(string $slug, string $id): RedirectResponse | Post

    public function show(string $slug, string $id): RedirectResponse | View
    {
        $post = Post::findOrFail($id);

        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        //return $post;
        return View('blog.show', [
            'post' => $post
        ]);
    }
}
