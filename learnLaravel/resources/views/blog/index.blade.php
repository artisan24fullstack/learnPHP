@extends('base')

@section('title', 'Accueil du blog')


@section('content')
    <h1>Mon blog</h1>

    {{-- @dump($posts); --}}

    @foreach ($posts as $post)
        <article>
            <h2>{{ $post->title }}</h2>
            <p class="small">
                @if ($post->category)
                    Catégorie : <strong>{{ $post->category?->name }}</strong>
                    @if (!$post->tags->isEmpty())
                    @endif
                @else
                    Aucune catégorie
                @endif
                <span> | </span>
                @if (!$post->tags->isEmpty())
                    Tags:
                    @foreach ($post->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                    @endforeach
                @else
                    Aucun tag
                @endif
            </p>
            @if ($post->image)
                <img style="with:100%;height:250px;object-fit:cover;" src="{{ $post->imageUrl() }}" />
            @endif
            <p>{{ $post->content }}</p>
            <p>
                <a class="btn btn-primary" href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}">
                    Lire la suite</a>
            </p>
        </article>
    @endforeach

    {{-- {{ route('blog.show', ['slug' => $post->slug, 'id' => $post->id]) }}  --}}

    {{-- AppServiceProvider.php -> boot() -> add Paginator::useBootstrapFive();  --}}


    {{ $posts->links() }}

@endsection
