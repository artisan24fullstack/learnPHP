@extends('base')

@section('title', $post->title)


@section('content')

    {{-- @dump($post); --}}

    <article>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
    </article>

@endsection
