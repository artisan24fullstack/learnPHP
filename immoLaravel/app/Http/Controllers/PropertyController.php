<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::paginate(16);
        return view('property.index', ['properties' => $properties]);
    }

    public function show(string $slug, Property $property)
    {
    }
}
