<div class="card">
    <div class='card-body'>
        <h5>
            <a
                href="{{ route('property.show', ['slug' => $property->getSlug(), 'property' => $property]) }}">{{ $property->title }}</a>
        </h5>
        <p class='card-text'>
            {{ $property->surface }}m² - {{ $property->city }} {{ $property->postal_code }}
        </p>
        <div class="text-primary" style="font-size: 1.4rem;">
            {{ number_format($property->price, thousands_separator: ' ') }} €
        </div>

    </div>
</div>
