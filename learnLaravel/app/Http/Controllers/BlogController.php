<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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
        $post = new Post();
        return view('blog.create', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get()
        ]);
    }

    //public function store(Request $request)
    public function store(FormPostRequest $request)
    {
        $post = Post::create($request->validated());
        $post->tags()->sync($request->validated('tags'));

        /*
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => Str::slug($request->input('title'))
        ]);
        */
        //dd($request->all());
        return redirect()
            ->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])
            ->with('success', "L'article a bien été sauvegardé");
    }

    public function edit(Post $post)
    {

        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get()
        ]);
    }

    public function update(Post $post, FormPostRequest $request)
    {

        //dd($request->validated('tags'));
        $post->update($request->validated());
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "L'article a bien été modifié");
    }

    //     public function index(BlogFilterRequest $request): View

    public function index(): View
    {

        //dd(Post::has('tags', '>=', 1)->get());
        //Post::has('tags', '>=', 2)->get();
        //$category = Category::find(2);
        //$post = Post::find(1);
        //dd($post->tags);
        //$tags = $post->tags()->detach(2);
        //$tags = $post->tags()->attach(2);
        //$tags = $post->tags()->sync([1, 2]);

        /*
        $post->tags()->createMany([[
            'name' => 'tag 1'
        ], [
            'name' => 'tag 2'

        ]]);
        */

        return view('blog.index', [
            'posts' => Post::with('tags', 'category')->paginate(5)
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
