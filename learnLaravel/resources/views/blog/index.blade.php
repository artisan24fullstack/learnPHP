@extends('base')

@section('title', 'Accueil du blog')


@section('content')
    <h1>Mon blog</h1>

    {{-- @dump($posts); --}}

    @foreach ($posts as $post)
        <article>
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <p>
                <a class="btn btn-primary" href="{{ route('blog.show', ['slug' => $post->slug, 'id' => $post->id]) }}">Lire la
                    suite</a>
            </p>
        </article>
    @endforeach


    {{-- AppServiceProvider.php -> boot() -> add Paginator::useBootstrapFive();  --}}


    {{ $posts->links() }}

@endsection
