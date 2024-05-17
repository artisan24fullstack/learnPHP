<form action="" method="post" class="vstack gap-2">
    @csrf

    {{-- @method($post->id ? 'PATCH' : 'POST') verbe HTTP --}}

    @method($post->id ? 'PATCH' : 'POST')

    <div class="form-group">
        <label>Titre</label>
        <input class="form-control" type="text" name="title" value="{{ old('title', $post->title) }}">
        @error('title')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label>Slug</label>
        <input class="form-control" type="text" name="slug" value="{{ old('slug', $post->slug) }}">
        @error('slug')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label>Contenu</label>
        <textarea class="form-control" name="content">{{ old('content', $post->content) }}</textarea>
        @error('content')
            {{ $message }}
        @enderror
    </div>
    <button class="btn btn-primary">
        @if ($post->id)
            Modifier
        @else
            Créer
        @endif
    </button>

</form>
