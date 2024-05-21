@extends('base')

@section('title', 'Tous nos biens')


@section('content')


    <div class="bg-light p-5 mb-5 text-center">
        <form action="" method="get" class="container d-flex gap-2">

            <input type="number" placeholder="Budget max" class="form-control" name="price" value="">
        </form>
    </div>
    <div class="container mt-5">
        <div class="row">
            @foreach ($properties as $property)
                <div class='col-3 mb-4'>
                    @include('property.card')
                </div>
            @endforeach
        </div>
        <div class="my-4">
            {{ $properties->links() }}
        </div>
    </div>


@endsection
