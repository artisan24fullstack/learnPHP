@extends('base')

@section('title', 'Modifier un article')


@section('content')
    <h1>Modification d'un article</h1>


    <form action="" method="post" class="vstack gap-2">
        @csrf
        <div>
            <label>Titre</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}">
            @error('title')
                {{ $message }}
            @enderror
        </div>
        <div>
            <label>Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $post->slug) }}">
            @error('slug')
                {{ $message }}
            @enderror
        </div>
        <div>
            <label>Contenu</label>
            <textarea name="content">{{ old('content', $post->content) }}</textarea>
            @error('content')
                {{ $message }}
            @enderror
        </div>
        <button>Enregistrer</button>

    </form>

@endsection
