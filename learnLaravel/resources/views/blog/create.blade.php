@extends('base')

@section('title', 'Créer un article')


@section('content')
    <h1>Création d'un article</h1>


    <form action="" method="post">
        @csrf
        <div>
            <label>Titre</label>
            <input type="text" name="title" value="{{ old('title', 'article démo') }}">
            @error('title')
                {{ $message }}
            @enderror
        </div>
        <div>
            <label>Slug</label>
            <input type="text" name="slug" value="">
            @error('slug')
                {{ $message }}
            @enderror
        </div>
        <div>
            <label>Contenu</label>
            <textarea name="content">{{ old('content', 'contenu démo') }}</textarea>
            @error('content')
                {{ $message }}
            @enderror
        </div>
        <button>Enregistrer</button>

    </form>

@endsection
