@extends('admin.admin')

@section('title', $property->exists ? 'Editer un bien' : 'Créer un bien')


@section('content')

    <h1>@yield('title')</h1>

    <form action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store', $property) }}"
        method="post">

        @csrf
        @method($property->exists ? 'put' : 'post')

        @include('shared.input', ['label' => 'titre', 'name' => 'title', 'value' => $property->title])
        <div>
            <button class="btn btn-primary">
                @if ($property->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>
    </form>
@endsection
