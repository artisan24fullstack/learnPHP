<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Administration </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <style>
        @layer demo {
            button {
                all: unset;
            }
        }
    </style>
</head>

<body>
    @php
        $routeName = request()->route()->getName();
    @endphp
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Agence</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' => str_contains($routeName, 'property.'),
                        ]) aria-current="page"
                            href="{{ route('admin.property.index') }}">Gérer les biens</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => str_contains($routeName, 'option.')]) aria-current="page"
                            href="{{ route('admin.option.index') }}">Gérer les options</a>
                    </li>
                </ul>
                <div class="ms-auto">
                    @auth

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="nav-link">Se déconnecter</button>
                                </form>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">

        @include('shared.flash')

        @yield('content')

    </div>
    <script>
        // Initialize Tom Select with multiple selections enabled
        let selectElement = document.querySelector('select[multiple]');
        let settings = {
            plugins: ['remove_button'], // Optional: Enable remove button plugin
            // Add any other settings you need
        };
        new TomSelect(selectElement, settings);
    </script>
</body>

</html>
