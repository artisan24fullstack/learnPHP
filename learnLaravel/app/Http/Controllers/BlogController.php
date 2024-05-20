<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FormPostRequest;
use App\Http\Requests\BlogFilterRequest;
use Illuminate\Support\Facades\Validator;

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

        $data = $request->validated();
        /**
         * @var UploadedFile|null $image
         * */

        //$image = $request->file('image');

        $image = $request->validated('image');
        if ($image !== null && !$image->getError()) {

            $data['image'] = $image->store('blog', 'public');
        }


        /*
        $imagePath =
        $data['image'] = $imagePath;
        dd($imagePath);
        */
        //dd($request->validated('tags'));
        //$post->update($request->validated());
        $post->update($data);
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "L'article a bien été modifié");
    }

    //     public function index(BlogFilterRequest $request): View

    public function index(): View
    {

        //dd(Auth::user());

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
