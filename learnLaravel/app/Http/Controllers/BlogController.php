<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\FormPostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    public function create()
    {
        //dd(session()->all());

        return view('blog.create');
    }

    //public function store(Request $request)
    public function store(FormPostRequest $request)
    {
        $post = Post::create($request->validated());
        /*
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => Str::slug($request->input('title'))
        ]);
        */
        //dd($request->all());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "L'article a bien été sauvegardé");
    }
    //     public function index(BlogFilterRequest $request): View

    public function index(): View
    {

        return view('blog.index', [
            'posts' => Post::paginate(1)
        ]);
    }

    //     public function show(string $slug, string $id): RedirectResponse | View

    public function show(string $slug, Post $post): RedirectResponse | View
    {
        //$post = Post::findOrFail($id);
        //dd($post);
        //$post = Post::findOrFail($post);

        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return View('blog.show', [
            'post' => $post
        ]);
    }
}
