@extends('base')

@section('title', 'Connexion')


@section('content')
    <h1>Se connecter</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('auth.login') }}" method="post" class="vstack gap-3">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" class="form-control" type="password" name="password">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
                <div class="d-grid gap-4 col-4 mx-auto">
                    <button class="btn btn-primary btn-lg">Se connecter</button>
                </div>
            </form>
        </div>
    </div>


@endsection
