@extends('base')

@section('title', 'Accueil')


@section('content')

    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Mon agence immo</h1>
            <p>
                Nunc non venenatis elit. Quisque elementum quis dui sed gravida. Duis quam orci, molestie quis consectetur
                vel, congue id magna. Cras feugiat mattis est a dapibus. Nunc ac purus eu risus dictum blandit. Vestibulum
                sit amet neque vitae nisi mattis volutpat. Donec aliquet tellus a dolor auctor, a blandit dui blandit.
            </p>
        </div>
    </div>
    <div class="container">
        <h2>Nos derniers biens</h2>
        <div class="row">
            @foreach ($properties as $property)
                <div class='col'>
                    @include('property.card')
                </div>
            @endforeach
        </div>
    </div>

@endsection
