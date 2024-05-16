<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class BlogController extends Controller
{

    public function index(BlogFilterRequest $request): View
    {
        // dd($request->validated());

        /*
        $Validator = Validator::make([
            'title' => 'aaaaaaaaa'
        ], [
            'title' => 'required|min:8'
        ]);
        */
        //dd($Validator->fails());
        //dd($Validator->errors());
        //dd($Validator->validated());

        return view('blog.index', [
            'posts' => Post::paginate(1)
        ]);
    }


    public function show(string $slug, string $id): RedirectResponse | View
    {
        $post = Post::findOrFail($id);

        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return View('blog.show', [
            'post' => $post
        ]);
    }
}
