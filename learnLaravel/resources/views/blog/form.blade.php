<form action="" method="post" class="vstack gap-2" enctype="multipart/form-data">
    @csrf

    {{-- @method($post->id ? 'PATCH' : 'POST') verbe HTTP --}}

    @method($post->id ? 'PATCH' : 'POST')

    <div class="form-group">
        <label for="image">Image</label>
        <input id="image" class="form-control" type="file" name="image">
        @error('image')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="title">Titre</label>
        <input id="title" class="form-control" type="text" name="title"
            value="{{ old('title', $post->title) }}">
        @error('title')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input id="slug" class="form-control" type="text" name="slug" value="{{ old('slug', $post->slug) }}">
        @error('slug')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Contenu</label>
        <textarea id="content" class="form-control" name="content">{{ old('content', $post->content) }}</textarea>
        @error('content')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="category">Catégorie</label>
        <select id="category" class="form-control" name="category_id">
            <option value="">Sélectionner une catégorie</option>
            @foreach ($categories as $category)
                <option @selected(old('category_id', $post->category_id) == $category->id) value={{ $category->id }}>{{ $category->name }}</option>
            @endforeach

        </select>
        @error('category_id')
            {{ $message }}
        @enderror
    </div>
    {{-- -
    @dump($post->tags->pluck('id'))
    select "tags".*, "post_tag"."post_id" as "pivot_post_id", "post_tag"."tag_id" as "pivot_tag_id" from "tags" inner join "post_tag" on "tags"."id" = "post_tag"."tag_id" where "post_tag"."post_id" = 1

    @dump($post->tags()->pluck('id'))
    select "id" from "tags" inner join "post_tag" on "tags"."id" = "post_tag"."tag_id" where "post_tag"."post_id" = 1

    The tags field must be an array.
        select  name="tags" multiple replace by name="tags[]"

    --}}
    @php
        $tagsIds = $post->tags->pluck('id');
    @endphp
    <div class="form-group">
        <label for="tag">Tags</label>
        <select id="tag" class="form-control" name="tags[]" multiple>
            @foreach ($tags as $tag)
                <option @selected($tagsIds->contains($tag->id)) value={{ $tag->id }}>{{ $tag->name }}</option>
            @endforeach

        </select>
        @error('tags')
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
