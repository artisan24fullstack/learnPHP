<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\FormPostRequest;
use App\Models\Category;
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
        $post = new Post();
        return view('blog.create', [
            'post' => $post
        ]);
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

    public function edit(Post $post)
    {

        return view('blog.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post, FormPostRequest $request)
    {

        $post->update($request->validated());

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "L'article a bien été modifié");
    }

    //     public function index(BlogFilterRequest $request): View

    public function index(): View
    {

        $category = Category::find(2);
        $post = Post::find(1);
        $post->category()->associate($category);
        $post->save();
        //dd($category->posts);

        //$posts = Post::all();
        //$post = Post::find(1);
        /*
        $posts = Post::with('category')->get(); //eager loading précharger une relation (category)
        foreach ($posts as $post) {
            $category = $post->category?->name;
        }
        */
        //$post = Post::find(1);
        //$category = $post->category->name;
        //dd($post->category->name);

        /*
        $post = Post::find(3);
        $post->category_id = 2;
        $post->save();
        */
        /*
        Category::create([
            'name' => "Catégorie 1"
        ]);
        Category::create([
            'name' => "Catégorie 2"
        ]);
        */
        return view('blog.index', [
            'posts' => Post::paginate(3)
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
