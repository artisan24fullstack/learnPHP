@extends('admin.admin')

@section('title', 'Tous les biens')


@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a class="btn btn-primary" href="{{ route('admin.property.create') }}">Ajouter un bien</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Surface</th>
                <th>Prix</th>
                <th>Ville</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($properties as $property)
                    <td>{{ $proterty->title }}</td>
                    <td>{{ $proterty->surface }}</td>
                    <td>{{ number_format($proterty->price, thousands_separator: ' ') }}</td>
                    <td>{{ $proterty->city }}</td>
                @endforeach
            </tr>

        </tbody>
    </table>

    {{ $properties->links() }}
@endsection
